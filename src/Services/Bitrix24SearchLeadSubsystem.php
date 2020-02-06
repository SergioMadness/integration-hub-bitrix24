<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24SearchLeadOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24SearchLeadSubsystem as IBitrix24SearchLeadSubsystem;

class Bitrix24SearchLeadSubsystem extends Bitrix24LeadSubsystem implements IBitrix24SearchLeadSubsystem
{
    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24SearchLeadOptions();
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
        if (isset($data['conditions'])) {
            $options = $this->getProcessOptions()->getOptions();
            $leads = $this->getBitrix24Service()
                ->setSettings($options)
                ->findLeads($data['conditions']);
            $eventData->setData(array_first($leads));
        }

        return $eventData;
    }
}