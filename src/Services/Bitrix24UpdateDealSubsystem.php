<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24DealOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24UpdateDealSubsystem as IBitrix24UpdateDealSubsystem;

class Bitrix24UpdateDealSubsystem extends Bitrix24DealSubsystem implements IBitrix24UpdateDealSubsystem
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
        $options = $this->getProcessOptions()->getOptions();

        $data = $eventData->getData();
        if (isset($data['id'])) {
            $this->getBitrix24Service()
                ->setSettings($options)
                ->updateDeal($data['id'], $data);
        }

        return $eventData;
    }
}
