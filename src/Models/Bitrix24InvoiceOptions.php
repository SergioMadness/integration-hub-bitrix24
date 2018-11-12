<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

class Bitrix24InvoiceOptions extends Bitrix24LeadOptions
{

//    /**
//     * Get available fields for mapping
//     *
//     * @return array
//     */
//    public function getAvailableFields(): array
//    {
//        $result = parent::getAvailableFields();
//
//        $result[] = 'document_id';
//
//        return $result;
//    }
//
//    /**
//     * Get service settings
//     *
//     * @return array
//     */
//    public function getOptions(): array
//    {
//        $result = parent::getOptions();
//
//        $result['templateId'] = [
//            'name' => 'Бизнес-процесс',
//            'type' => 'string',
//        ];
//
//        return $result;
//    }
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