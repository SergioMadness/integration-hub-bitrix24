<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24InvoiceOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24InvoiceSubsystem as IBitrix24InvoiceSubsystem;

/**
 * Subsystem to set status "approved" to invoice in Bitrix24
 * @package professionalweb\IntegrationHub\Bitrix24\Services
 */
class Bitrix24InvoiceApproveSubsystem extends Bitrix24LeadSubsystem implements IBitrix24InvoiceSubsystem
{
    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24InvoiceOptions();
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

        $this->getBitrix24Service()
            ->setSettings($options)
            ->sendInvoice($eventData->getData());

        return $eventData;
    }
}