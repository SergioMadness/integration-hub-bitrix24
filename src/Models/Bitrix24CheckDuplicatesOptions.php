<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

/**
 * Subsystem options
 * @package professionalweb\IntegrationHub\Bitrix24\Models
 */
class Bitrix24CheckDuplicatesOptions extends Bitrix24LeadOptions
{

    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [
            'contact' => 'contact',
        ];
    }
}