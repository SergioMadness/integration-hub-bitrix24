<?php namespace professionalweb\IntegrationHub\Bitrix24\Interfaces;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;

/**
 * Interface for subsystem to update lead
 * @package professionalweb\IntegrationHub\Bitrix24\Interfaces
 */
interface Bitrix24UpdateLeadSubsystem extends Subsystem
{
    public const BITRIX24_UPDATE_LEAD = 'bitrix-update-lead';
}