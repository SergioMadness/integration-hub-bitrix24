<?php

declare(strict_types=1);

namespace professionalweb\IntegrationHub\Bitrix24\Models;

/**
 * Subsystem options
 * @package professionalweb\IntegrationHub\Bitrix24\Models
 */
class Bitrix24LeadDistributionOptions extends Bitrix24LeadOptions
{

    /**
     * Get available fields for mapping
     */
    public function getAvailableFields(): array
    {
        return [
            'bitrix_manager_id',
        ];
    }

    /**
     * Get service settings
     */
    public function getOptions(): array
    {
        return [
            'url' => [
                'name' => 'Домен',
                'type' => 'string',
            ],
            'hook' => [
                'name' => 'Hook',
                'type' => 'string',
            ],
            'filter' => [
                'name' => 'Настройки фильтра',
                'type' => 'array',
            ],
            'onlY_online' => [
                'name' => 'Только online',
                'type' => 'bool',
            ],
        ];
    }

    /**
     * Get array fields, that subsystem generates
     */
    public function getAvailableOutFields(): array
    {
        return [];
    }
}