<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24ContactOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24SearchContactSubsystem as IBitrix24SearchContactSubsystem;

/**
 * Subsystem to look for contacts
 * @package professionalweb\IntegrationHub\Bitrix24\Services
 */
class Bitrix24SearchContactSubsystem extends Bitrix24LeadSubsystem implements IBitrix24SearchContactSubsystem
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
        if (isset($data['conditions'])) {
            $options = $this->getProcessOptions()->getOptions();
            $contacts = $this->getBitrix24Service()
                ->setSettings($options)
                ->findContacts($data['conditions']);
            $eventData->setData(array_first($contacts));
        }

        return $eventData;
    }
}