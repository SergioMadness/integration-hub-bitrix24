<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24GetContactOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24GetContactSubsystem as IBitrix24GetContactSubsystem;

/**
 * Class Bitrix24GetContactSubsystem
 * @package professionalweb\IntegrationHub\Bitrix24\Services
 */
class Bitrix24GetContactSubsystem extends Bitrix24LeadSubsystem implements IBitrix24GetContactSubsystem
{
    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24GetContactOptions();
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
        $id = $eventData->get('id');
        if (!empty($id)) {
            $eventData->setData($this->getBitrix24Service()->getContact($id));
        }

        return $eventData;
    }
}
