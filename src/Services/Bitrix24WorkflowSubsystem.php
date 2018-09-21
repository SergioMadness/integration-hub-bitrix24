<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24StartWorkflowOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24WorkflowSubsystem as IBitrix24WorkflowSubsystem;

/**
 * Bitrix24 subsystem to start workflow for document
 * @package professionalweb\IntegrationHub\Bitrix24\Services
 */
class Bitrix24WorkflowSubsystem extends Bitrix24LeadSubsystem implements IBitrix24WorkflowSubsystem
{

    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24StartWorkflowOptions();
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
            ->startWorkflow($options['templateId'], $eventData->getData()['document_id']);

        return $eventData;
    }
}