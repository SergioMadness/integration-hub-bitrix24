<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24GetDealOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24GetDealSubsystem as IBitrix24GetDealSubsystem;

/**
 * Subsystem to get deal data by id
 * @package professionalweb\IntegrationHub\Bitrix24\Services
 */
class Bitrix24GetDealSubsystem extends Bitrix24LeadSubsystem implements IBitrix24GetDealSubsystem
{
    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24GetDealOptions();
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
        if (isset($data['deal_id'])) {
            $options = $this->getProcessOptions()->getOptions();
            $deal = $this->getBitrix24Service()
                ->setSettings($options)
                ->getDeal($data['deal_id']);
            $eventData->setData($deal);
        }

        return $eventData;
    }
}