<?php namespace professionalweb\IntegrationHub\Bitrix24\Listeners;

use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24LeadSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24ContactSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24WorkflowSubsystem;
use professionalweb\IntegrationHub\Bitrix24\Services\Bitrix24InvoiceApproveSubsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24LeadDistributionSubsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Events\EventToProcess;

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
        }

        if ($subsystem !== null) {
            return $subsystem->setProcessOptions($eventToProcess->getProcessOptions())->process($eventToProcess->getEventData());
        }
    }
}