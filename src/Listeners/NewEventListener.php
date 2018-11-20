<?php namespace professionalweb\IntegrationHub\Bitrix24\Listeners;

use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24DealSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24LeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24InvoiceSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24GetDealSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24ContactSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24WorkflowSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24GetInvoiceSubsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24UpdateInvoiceSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24ConvertCurrencySubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24CheckDuplicatesSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24LeadDistributionSubsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Events\EventToProcess;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24SetInvoiceStatusSubsystem;

class NewEventListener
{
    public function handle(EventToProcess $eventToProcess)
    {
        /** @var Subsystem $subsystem */
        $subsystem = null;
        switch ($eventToProcess->getProcessOptions()->getSubsystemId()) {
            case Bitrix24LeadSubsystem::BITRIX24_LEAD:
                /** @var Bitrix24LeadSubsystem $subsystem */
                $subsystem = app(Bitrix24LeadSubsystem::class);
                break;
            case Bitrix24ContactSubsystem::BITRIX24_CONTACT:
                /** @var Bitrix24ContactSubsystem $subsystem */
                $subsystem = app(Bitrix24ContactSubsystem::class);
                break;
            case Bitrix24LeadDistributionSubsystem::BITRIX24_LEAD_DISTRIBUTION:
                /** @var Bitrix24LeadDistributionSubsystem $subsystem */
                $subsystem = app(Bitrix24LeadDistributionSubsystem::class);
                break;
            case Bitrix24WorkflowSubsystem::BITRIX24_WORKFLOW:
                /** @var Bitrix24WorkflowSubsystem $subsystem */
                $subsystem = app(Bitrix24WorkflowSubsystem::class);
                break;
            case Bitrix24CheckDuplicatesSubsystem::BITRIX24_CHECK_DUPLICATES:
                /** @var Bitrix24CheckDuplicatesSubsystem $subsystem */
                $subsystem = app(Bitrix24CheckDuplicatesSubsystem::class);
                break;
            case Bitrix24UpdateInvoiceSubsystem::BITRIX24_UPDATE_INVOICE:
                $subsystem = app(Bitrix24UpdateInvoiceSubsystem::class);
                break;
            case Bitrix24ConvertCurrencySubsystem::BITRIX24_CONVERT_CURRENCY:
                $subsystem = app(Bitrix24ConvertCurrencySubsystem::class);
                break;
            case Bitrix24GetInvoiceSubsystem::BITRIX24_GET_INVOICE:
                $subsystem = app(Bitrix24GetInvoiceSubsystem::class);
                break;
            case Bitrix24SetInvoiceStatusSubsystem::BITRIX24_SET_INVOICE_STATUS:
                $subsystem = app(Bitrix24SetInvoiceStatusSubsystem::class);
                break;
            case Bitrix24GetDealSubsystem::BITRIX24_GET_DEAL:
                $subsystem = app(Bitrix24GetDealSubsystem::class);
                break;
            case Bitrix24DealSubsystem::BITRIX24_CREATE_DEAL:
                $subsystem = app(Bitrix24DealSubsystem::class);
                break;
            case Bitrix24InvoiceSubsystem::BITRIX24_INVOICE:
                $subsystem = app(Bitrix24InvoiceSubsystem::class);
                break;
        }

        if ($subsystem !== null) {
            return $subsystem->setProcessOptions($eventToProcess->getProcessOptions())->process($eventToProcess->getEventData());
        }
    }
}