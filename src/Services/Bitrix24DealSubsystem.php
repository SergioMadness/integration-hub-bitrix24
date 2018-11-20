<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24DealOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24DealSubsystem as IBitrix24DealSubsystem;

class Bitrix24DealSubsystem extends Bitrix24LeadSubsystem implements IBitrix24DealSubsystem
{
    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24DealOptions();
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
        $options = $this->getProcessOptions()->getOptions();
        $result['deal_id'] = $this->getBitrix24Service()
            ->setSettings($options)
            ->sendDeal($data);
        $eventData->setData($result);

        return $eventData;
    }
}