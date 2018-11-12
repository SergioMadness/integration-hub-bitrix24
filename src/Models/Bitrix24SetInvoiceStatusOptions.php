<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

class Bitrix24SetInvoiceStatusOptions extends Bitrix24LeadOptions
{

    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [
            'ID'        => 'ID',
            'STATUS_ID' => 'Идентификатор статуса',
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

        $result['status'] = [
            'name' => 'Статус',
            'type' => 'string',
        ];

        return $result;
    }

    /**
     * Get array fields, that subsystem generates
     *
     * @return array
     */
    public function getAvailableOutFields(): array
    {
        return [];
    }
}