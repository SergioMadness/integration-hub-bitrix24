<?php namespace professionalweb\IntegrationHub\Bitrix24\Interfaces;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;

/**
 * Interface for service to get product by id
 * @package professionalweb\IntegrationHub\Bitrix24\Interfaces
 */
interface Bitrix24GetProductSubsystem extends Subsystem
{
    public const BITRIX24_GET_PRODUCT = 'bitrix-get-product';
}