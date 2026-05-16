<?php

declare(strict_types=1);

namespace professionalweb\IntegrationHub\Bitrix24\Models;

class Bitrix24SearchDealOptions extends Bitrix24DealOptions
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