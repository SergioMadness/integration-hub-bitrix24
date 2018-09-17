<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;

/**
 * Subsystem options
 * @package professionalweb\IntegrationHub\Bitrix24\Models
 */
class Bitrix24LeadOptions implements SubsystemOptions
{

    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [];
    }

    /**
     * Get service settings
     *
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'url'  => [
                'name' => 'Домен',
                'type' => 'string',
            ],
            'hook' => [
                'name' => 'Hook',
                'type' => 'string',
            ],
        ];
    }
}