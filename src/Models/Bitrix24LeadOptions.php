<?php namespace professionalweb\IntegrationHub\Bitrix24\Models;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;

/**
 * Subsystem options
 * @package professionalweb\IntegrationHub\Bitrix24\Models
 */
class Bitrix24LeadOptions implements SubsystemOptions
{

    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
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
        ];
    }

    /**
     * Get service settings
     *
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'url'  => [
                'name' => 'Домен',
                'type' => 'string',
            ],
            'hook' => [
                'name' => 'Hook',
                'type' => 'string',
            ],
        ];
    }
}