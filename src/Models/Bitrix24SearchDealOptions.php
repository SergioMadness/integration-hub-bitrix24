<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

class Bitrix24SearchDealOptions extends Bitrix24DealOptions
{

    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [
            'conditions' => 'conditions',
        ];
    }
}