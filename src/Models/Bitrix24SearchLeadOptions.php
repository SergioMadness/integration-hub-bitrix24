<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

class Bitrix24SearchLeadOptions extends Bitrix24LeadOptions
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

    /**
     * Get array fields, that subsystem generates
     *
     * @return array
     */
    public function getAvailableOutFields(): array
    {
        return [
            'ADDRESS'              => 'ADDRESS',
            'ADDRESS_2'            => 'ADDRESS_2',
            'ADDRESS_CITY'         => 'ADDRESS_CITY',
            'ADDRESS_COUNTRY'      => 'ADDRESS_COUNTRY',
            'ADDRESS_COUNTRY_CODE' => 'ADDRESS_COUNTRY_CODE',
            'ADDRESS_POSTAL_CODE'  => 'ADDRESS_POSTAL_CODE',
            'ADDRESS_PROVINCE'     => 'ADDRESS_PROVINCE',
            'ADDRESS_REGION'       => 'ADDRESS_REGION',
            'BIRTHDATE'            => 'BIRTHDATE',
            'COMMENTS'             => 'COMMENTS',
            'CLIENT_ID'            => 'CONTACT_ID',
            'EMAIL'                => 'EMAIL',
            'NAME'                 => 'NAME',
            'PHONE'                => 'PHONE',
            'POST'                 => 'POST',
            'SECOND_NAME'          => 'SECOND_NAME',
            'SOURCE_DESCRIPTION'   => 'SOURCE_DESCRIPTION',
            'TITLE'                => 'TITLE',
            'UTM_CAMPAIGN'         => 'UTM_CAMPAIGN',
            'UTM_CONTENT'          => 'UTM_CONTENT',
            'UTM_MEDIUM'           => 'UTM_MEDIUM',
            'UTM_SOURCE'           => 'UTM_SOURCE',
            'UTM_TERM'             => 'UTM_TERM',
            'WEB'                  => 'WEB',
            'PRODUCTS'             => 'PRODUCTS',
            'STATUS_ID'            => 'STATUS_ID',
        ];
    }
}