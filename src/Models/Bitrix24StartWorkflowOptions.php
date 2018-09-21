<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

class Bitrix24StartWorkflowOptions extends Bitrix24LeadOptions
{

    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        $result = parent::getAvailableFields();

        $result[] = 'document_id';

        return $result;
    }

    /**
     * Get service settings
     *
     * @return array
     */
    public function getOptions(): array
    {
        $result = parent::getOptions();

        $result['templateId'] = [
            'name' => 'Бизнес-процесс',
            'type' => 'string',
        ];

        return $result;
    }
}