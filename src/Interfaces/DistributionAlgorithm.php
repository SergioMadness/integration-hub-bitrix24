<?php namespace professionalweb\IntegrationHub\Bitrix24\Interfaces;

/**
 * Interface for distribution algorithms
 * @package professionalweb\IntegrationHub\Bitrix24\Interfaces
 */
interface DistributionAlgorithm
{
    /**
     * Get user id
     *
     * @param array  $ids
     * @param string $group
     *
     * @return mixed
     */
    public function getUserId(array $ids, ?string $group = null);
}