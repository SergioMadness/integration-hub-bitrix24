<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24Service;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24LeadDistributionOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\ProcessOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Interfaces\DistributionService;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24LeadDistributionSubsystem as IBitrix24LeadDistributionSubsystem;

/**
 * Subsystem to select user to assign lead
 * @package professionalweb\IntegrationHub\Bitrix24\Services
 */
class Bitrix24LeadDistributionSubsystem implements IBitrix24LeadDistributionSubsystem
{
    /**
     * @var ProcessOptions
     */
    private $processOptions;

    /**
     * @var DistributionService
     */
    private $distributionService;

    /**
     * @var Bitrix24Service
     */
    private $bitrix24Service;

    public function __construct(DistributionService $distributionService, Bitrix24Service $bitrix24Service)
    {
        $this->setDistributionService($distributionService)->setBitrix24Service($bitrix24Service);
    }

    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24LeadDistributionOptions();
    }

    /**
     * Process event data
     *
     * @param EventData $eventData
     *
     * @return EventData
     */
    public function process(EventData $eventData): EventData
    {
        $data = $eventData->getData();
        $onlyOnlineUsers = $this->getProcessOptions()->getOptions()['only_online'] ?? false;
        $bitrixService = $this->getBitrix24Service();
        $bitrixService->setSettings($this->getProcessOptions()->getOptions());
        $firstUserId = 0;
        $needToStop = false;
        $qty = 0;
        do {
            $data['assigned_by_id'] = $this->getDistributionService()
                ->getUserId(
                    $this->getProcessOptions()->getOptions()['filter'] ?? [],
                    $data
                );
            if (!empty($data['assigned_by_id'])) {
                if ($onlyOnlineUsers && !$bitrixService->isUserOnline($data['assigned_by_id'])) {
                    $data['assigned_by_id'] = 0;
                } else {
                    $needToStop = true;
                }
                if ($firstUserId === 0) {
                    $firstUserId = $data['assigned_by_id'];
                }
            } else {
                $needToStop = true;
            }
            $qty++;
        } while ($qty < 100 && !$needToStop);

        if (!empty($data['assigned_by_id'])) {
            $data['status_id'] = $this->getProcessOptions()->getOptions()['status_id'] ?? '';
        }

        return $eventData->setData($data);
    }

    /**
     * Set options with values
     *
     * @param ProcessOptions $options
     *
     * @return Subsystem
     */
    public function setProcessOptions(ProcessOptions $options): Subsystem
    {
        $this->processOptions = $options;

        return $this;
    }

    /**
     * @return ProcessOptions
     */
    public function getProcessOptions(): ProcessOptions
    {
        return $this->processOptions;
    }

    /**
     * @return DistributionService
     */
    public function getDistributionService(): DistributionService
    {
        return $this->distributionService;
    }

    /**
     * @param DistributionService $distributionService
     *
     * @return Bitrix24LeadDistributionSubsystem
     */
    public function setDistributionService(DistributionService $distributionService): self
    {
        $this->distributionService = $distributionService;

        return $this;
    }

    /**
     * @return Bitrix24Service
     */
    public function getBitrix24Service(): Bitrix24Service
    {
        return $this->bitrix24Service;
    }

    /**
     * @param Bitrix24Service $bitrix24Service
     *
     * @return Bitrix24LeadDistributionSubsystem
     */
    public function setBitrix24Service(Bitrix24Service $bitrix24Service): self
    {
        $this->bitrix24Service = $bitrix24Service;

        return $this;
    }
}