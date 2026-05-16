<?php

declare(strict_types=1);

namespace professionalweb\IntegrationHub\Bitrix24\Models;

class Bitrix24StartWorkflowOptions extends Bitrix24LeadOptions
{

    /**
     * Get available fields for mapping
     */
    public function getAvailableFields(): array
    {
        $result = parent::getAvailableFields();

        $result['document_id'] = 'document_id';

        return $result;
    }

    /**
     * Get service settings
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

    /**
     * Get array fields, that subsystem generates
     */
    public function getAvailableOutFields(): array
    {
        return [];
    }
}