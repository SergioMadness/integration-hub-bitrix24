<?php

declare(strict_types=1);

namespace professionalweb\IntegrationHub\Bitrix24\Services;

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
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24SetInvoiceStatusOptions();
    }

    /**
     * Process event data
     */
    public function process(EventData $eventData): EventData
    {
        $options = $this->getProcessOptions()->getOptions();

        $data = $eventData->getData();

        $this->getBitrix24Service()
            ->setSettings($options)
            ->updateInvoice(
                $data['id'],
                array_merge(['STATUS_ID' => $options['status'] ?? 'P'], $data)
            );

        return $eventData;
    }
}