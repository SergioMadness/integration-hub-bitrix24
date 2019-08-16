<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24GetLeadOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24GetLeadSubsystem as IBitrix24GetLeadSubsystem;

class Bitrix24GetLeadSubsystem extends Bitrix24LeadSubsystem implements IBitrix24GetLeadSubsystem
{
    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24GetLeadOptions();
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
        if (isset($data['id'])) {
            $options = $this->getProcessOptions()->getOptions();
            $invoice = $this->getBitrix24Service()
                ->setSettings($options)
                ->getLead($data['id']);
            $eventData->setData($invoice);
        }

        return $eventData;
    }
}