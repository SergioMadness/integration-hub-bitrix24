<?php namespace professionalweb\IntegrationHub\Bitrix24\Interfaces;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;

interface Bitrix24ConvertCurrencySubsystem extends Subsystem
{
    public const BITRIX24_GET_INVOICE = 'bitrix-convert-currency';
}