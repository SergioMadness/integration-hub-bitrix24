<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

class Bitrix24GetProductOptions extends Bitrix24LeadOptions
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
     * Get array fields, that subsystem generates
     *
     * @return array
     */
    public function getAvailableOutFields(): array
    {
        return [
            'ACTIVE'           => 'ACTIVE',
            'CATALOG_ID'       => 'CATALOG_ID',
            'CREATED_BY'       => 'CREATED_BY',
            'CURRENCY_ID'      => 'CURRENCY_ID',
            'DATE_CREATE'      => 'DATE_CREATE',
            'DESCRIPTION'      => 'DESCRIPTION',
            'DESCRIPTION_TYPE' => 'DESCRIPTION_TYPE',
            'DETAIL_PICTURE'   => 'DETAIL_PICTURE',
            'ID'               => 'ID',
            'MEASURE'          => 'MEASURE',
            'MODIFIED_BY'      => 'MODIFIED_BY',
            'NAME'             => 'NAME',
            'PREVIEW_PICTURE'  => 'PREVIEW_PICTURE',
            'PRICE'            => 'PRICE',
            'SECTION_ID'       => 'SECTION_ID',
            'SORT'             => 'SORT',
            'TIMESTAMP_X'      => 'TIMESTAMP_X',
            'VAT_ID'           => 'VAT_ID',
            'VAT_INCLUDED'     => 'VAT_INCLUDED',
            'XML_ID'           => 'XML_ID',
        ];
    }
}