<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24GetInvoiceOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24GetInvoiceSubsystem as IBitrix24GetInvoiceSubsystem;

/**
 * Subsystem to get invoice data by id
 * @package professionalweb\IntegrationHub\Bitrix24\Services
 */
class Bitrix24GetInvoiceSubsystem extends Bitrix24LeadSubsystem implements IBitrix24GetInvoiceSubsystem
{
    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24GetInvoiceOptions();
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
        if (isset($data['id'])) {
            $options = $this->getProcessOptions()->getOptions();
            $invoice = $this->getBitrix24Service()
                ->setSettings($options)
                ->getInvoice($data['id']);
            $eventData->setData($invoice);
        }

        return $eventData;
    }
}