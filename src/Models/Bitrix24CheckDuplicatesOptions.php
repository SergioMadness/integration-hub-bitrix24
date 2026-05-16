<?php

declare(strict_types=1);

namespace professionalweb\IntegrationHub\Bitrix24\Models;

/**
 * Subsystem options
 * @package professionalweb\IntegrationHub\Bitrix24\Models
 */
class Bitrix24CheckDuplicatesOptions extends Bitrix24LeadOptions
{

    /**
     * Get available fields for mapping
     */
    public function getAvailableFields(): array
    {
        return [
            'contact' => 'contact',
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