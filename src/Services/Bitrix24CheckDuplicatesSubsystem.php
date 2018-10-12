<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24CheckDuplicatesOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24CheckDuplicatesSubsystem as IBitrix24CheckDuplicatesSubsystem;

/**
 * Subsystem to set status "Duplicate"
 * @package professionalweb\IntegrationHub\Bitrix24\Services
 */
class Bitrix24CheckDuplicatesSubsystem extends Bitrix24LeadSubsystem implements IBitrix24CheckDuplicatesSubsystem
{

    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24CheckDuplicatesOptions();
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

        if ($this->getBitrix24Service()->setSettings($this->getProcessOptions()->getOptions())->hasDuplicates($data['contact'] ?? '')) {
            $data['STATUS_ID'] = $this->getProcessOptions()->getOptions()['status_id'] ?? '';
        }

        return $eventData->setData($data);
    }
}