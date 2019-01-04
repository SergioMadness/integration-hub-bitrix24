<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24IsUserOnlineOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24IsUserOnlineSubsystem as IBitrix24IsUserOnlineSubsystem;

/**
 * Subsystem to get employee status data by user id
 * @package professionalweb\IntegrationHub\Bitrix24\Services
 */
class Bitrix24IsUserOnlineSubsystem extends Bitrix24LeadSubsystem implements IBitrix24IsUserOnlineSubsystem
{
    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24IsUserOnlineOptions();
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
        if (isset($data['user_id'])) {
            $options = $this->getProcessOptions()->getOptions();
            $isOnline = $this->getBitrix24Service()
                ->setSettings($options)
                ->isUserOnline($data['user_id']);
            $eventData->setData([
                $data['user_id'] => $isOnline,
            ]);
        }

        return $eventData;
    }
}