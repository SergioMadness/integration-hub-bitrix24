<?php namespace professionalweb\IntegrationHub\Bitrix24\Interfaces;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;

interface Bitrix24IsUserOnlineSubsystem extends Subsystem
{
    public const BITRIX24_GET_EMPLOYEE_STATUS = 'bitrix-get-employee-status';
}