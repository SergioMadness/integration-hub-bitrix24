<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24SearchDealOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24SearchDealSubsystem as IBitrix24SearchDealSubsystem;

class Bitrix24SearchDealSubsystem extends Bitrix24DealSubsystem implements IBitrix24SearchDealSubsystem
{
    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24SearchDealOptions();
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
            $deals = $this->getBitrix24Service()
                ->setSettings($options)
                ->findDeals($data['conditions']);
            $eventData->setData(array_first($deals));
        }

        return $eventData;
    }
}