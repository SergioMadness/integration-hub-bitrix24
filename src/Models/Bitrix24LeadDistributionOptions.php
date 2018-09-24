<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

/**
 * Subsystem options
 * @package professionalweb\IntegrationHub\Bitrix24\Models
 */
class Bitrix24LeadDistributionOptions extends Bitrix24LeadOptions
{

    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [
            'bitrix_manager_id',
        ];
    }

    /**
     * Get service settings
     *
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'url'    => [
                'name' => 'Домен',
                'type' => 'string',
            ],
            'hook'   => [
                'name' => 'Hook',
                'type' => 'string',
            ],
            'filter' => [
                'name' => 'Настройки фильтра',
                'type' => 'array',
            ],
        ];
    }
}