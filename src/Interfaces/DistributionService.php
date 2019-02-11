<?php namespace professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Interfaces;

/**
 * Interface for distribution service
 * @package professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Interfaces
 */
interface DistributionService
{
    /**
     * Get user id
     *
     * @param array $users
     *
     * @return mixed
     */
    public function getUserId(array $users);
}