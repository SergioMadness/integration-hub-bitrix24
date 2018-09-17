<?php namespace professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Interfaces;

/**
 * Interface for distribution algorithms
 * @package professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Interfaces
 */
interface DistributionAlgorithm
{
    /**
     * Get user id
     *
     * @param array $ids
     *
     * @return mixed
     */
    public function getUserId(array $ids);
}