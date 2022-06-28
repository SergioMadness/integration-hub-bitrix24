<?php namespace professionalweb\IntegrationHub\Bitrix24\Interfaces;

/**
 * Interface for distribution service
 * @package professionalweb\IntegrationHub\Bitrix24\Interfaces
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