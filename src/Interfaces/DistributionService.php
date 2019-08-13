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
     * @param array       $users
     *
     * @param string|null $group
     *
     * @return mixed
     */
    public function getUserId(array $users, string $group = null);
}