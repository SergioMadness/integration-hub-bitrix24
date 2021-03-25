<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24LeadOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24UpdateLeadSubsystem as IBitrix24UpdateLeadSubsystem;

class Bitrix24UpdateLeadSubsystem extends Bitrix24LeadSubsystem implements IBitrix24UpdateLeadSubsystem
{
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
        $options = $this->getProcessOptions()->getOptions();

        $data = $eventData->getData();
        if (isset($data['id'])) {
            $this->getBitrix24Service()
                ->setSettings($options)
                ->updateLead($data['id'], $data);
        }

        return $eventData;
    }
}
