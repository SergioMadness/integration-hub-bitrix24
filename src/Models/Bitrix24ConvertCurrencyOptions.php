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
        ];
    }

    /**
     * Get service settings
     *
     * @return array
     */
    public function getOptions(): array
    {
        $result = parent::getOptions();

        $result['to_currency'] = [
            'name' => 'Целевая валюта',
            'type' => 'string',
        ];

        return $result;
    }
}