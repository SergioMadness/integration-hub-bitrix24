<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24ContactOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24ContactSubsystem as IBitrix24ContactSubsystem;

class Bitrix24ContactSubsystem extends Bitrix24LeadSubsystem implements IBitrix24ContactSubsystem
{

    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24ContactOptions();
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
        $data['contact_id'] = $this->getBitrix24Service()->sendContact($data);
        $eventData->setData($data);

        return $eventData;
    }
}