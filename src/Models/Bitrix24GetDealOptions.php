<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

class Bitrix24GetDealOptions extends Bitrix24LeadOptions
{

    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [
            'ID' => 'ID',
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

        $result['need_fields'] = [
            'name' => 'Получить параметры',
            'type' => 'list',
        ];

        return $result;
    }
}