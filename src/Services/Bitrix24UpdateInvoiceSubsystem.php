<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24UpdateInvoiceOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24UpdateInvoiceSubsystem as IBitrix24UpdateInvoiceSubsystem;

/**
 * Subsystem to update invoice
 * @package professionalweb\IntegrationHub\Bitrix24\Services
 */
class Bitrix24UpdateInvoiceSubsystem extends Bitrix24LeadSubsystem implements IBitrix24UpdateInvoiceSubsystem
{
    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24UpdateInvoiceOptions();
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