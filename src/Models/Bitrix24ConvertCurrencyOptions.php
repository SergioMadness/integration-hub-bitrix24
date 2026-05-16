<?php

declare(strict_types=1);

namespace professionalweb\IntegrationHub\Bitrix24\Models;

class Bitrix24ConvertCurrencyOptions extends Bitrix24LeadOptions
{

    /**
     * Get available fields for mapping
     */
    public function getAvailableFields(): array
    {
        return [
            'from_currency' => 'From currency',
            'to_currency' => 'To currency',
            'amount' => 'Amount',
        ];
    }

    /**
     * Get array fields, that subsystem generates
     */
    public function getAvailableOutFields(): array
    {
        return [
            'base_amount' => 'Сконвертированная сумма',
        ];
    }
}