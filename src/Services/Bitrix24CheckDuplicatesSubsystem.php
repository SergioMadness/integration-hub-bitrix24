<?php namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24Service;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\Bitrix24\Models\Bitrix24CheckDuplicatesOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Bitrix24\Interfaces\Bitrix24CheckDuplicatesSubsystem as IBitrix24CheckDuplicatesSubsystem;

/**
 * Subsystem to set status "Duplicate"
 * @package professionalweb\IntegrationHub\Bitrix24\Services
 */
class Bitrix24CheckDuplicatesSubsystem extends Bitrix24LeadSubsystem implements IBitrix24CheckDuplicatesSubsystem
{

    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new Bitrix24CheckDuplicatesOptions();
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
        $contacts = $data['contacts'] ?? [];
        $options = $this->getProcessOptions()->getOptions();
        $service = $this->getBitrix24Service()->setSettings($options);
        $areas = $options['areas'] ?? [Bitrix24Service::DOCUMENT_TYPE_LEAD, Bitrix24Service::DOCUMENT_TYPE_COMPANY, Bitrix24Service::DOCUMENT_TYPE_CONTACT];
        $found = false;
        foreach ($contacts as $contact) {
            foreach ($areas as $area) {
                if ($service->hasDuplicates($contact, $area)) {
                    $data['STATUS_ID'] = $this->getProcessOptions()->getOptions()['status_id'] ?? '';
                    $found = true;
                    break;
                }
            }
            if ($found) {
                break;
            }
        }

        return $eventData->setData($data);
    }
}