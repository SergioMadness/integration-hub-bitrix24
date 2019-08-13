<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24LeadOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24Service;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\ProcessOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24LeadSubsystem as IBitrix24LeadSubsystem;

class Bitrix24LeadSubsystem implements IBitrix24LeadSubsystem
{
    /**
     * @var Bitrix24Service
     */
    private $bitrix24Service;

    /**
     * @var ProcessOptions
     */
    private $processOptions;

    public function __construct(Bitrix24Service $bitrix24Service)
    {
        $this->setBitrix24Service($bitrix24Service);
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
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24LeadOptions();
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
        $result['lead_id'] = $this->getBitrix24Service()
            ->setSettings($this->getProcessOptions()->getOptions())
            ->sendLead($data);
        $eventData->setData($result);

        return $eventData;
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
     * @return $this
     */
    public function setBitrix24Service(Bitrix24Service $bitrix24Service): self
    {
        $this->bitrix24Service = $bitrix24Service;

        return $this;
    }

    /**
     * @return ProcessOptions
     */
    public function getProcessOptions(): ProcessOptions
    {
        return $this->processOptions;
    }
}