<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24SetInvoiceStatusOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24SetInvoiceStatusSubsystem as IBitrix24SetInvoiceStatusSubsystem;

/**
 * Subsystem to set status to invoice
 * @package professionalweb\IntegrationHub\Bitrix24\Services
 */
class Bitrix24SetInvoiceStatusSubsystem extends Bitrix24LeadSubsystem implements IBitrix24SetInvoiceStatusSubsystem
{
    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24SetInvoiceStatusOptions();
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

        $this->getBitrix24Service()
            ->setSettings($options)
            ->updateInvoice($data['id'], ['STATUS_ID' => $options['status'] ?? 'P']);

        return $eventData;
    }
}