<?php

declare(strict_types=1);

namespace professionalweb\IntegrationHub\Bitrix24\Models;

/**
 * Search contact subsystem options
 * @package professionalweb\IntegrationHub\Bitrix24\Models
 */
class Bitrix24SearchContactOptions extends Bitrix24ContactOptions
{

    /**
     * Get available fields for mapping
     */
    public function getAvailableFields(): array
    {
        return [
            'conditions' => 'conditions',
        ];
    }
}