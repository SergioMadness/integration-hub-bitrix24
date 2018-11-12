<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

class Bitrix24ConvertCurrencyOptions extends Bitrix24LeadOptions
{

    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [
            'from_currency' => 'From currency',
            'to_currency'   => 'To currency',
            'amount'        => 'Amount',
        ];
    }

    /**
     * Get array fields, that subsystem generates
     *
     * @return array
     */
    public function getAvailableOutFields(): array
    {
        return [
            'base_amount' => 'Сконвертированная сумма',
        ];
    }
}