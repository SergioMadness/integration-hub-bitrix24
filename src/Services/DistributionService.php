<?php namespace professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Services;

use professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Interfaces\DistributionAlgorithm;
use professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Interfaces\DistributionService as IDistributionService;

/**
 * Service to distribute leads between users
 * @package professionalweb\IntegrationHub\DrivBitrix24ers\Bitrix24LeadDistribution\Services
 */
class DistributionService implements IDistributionService
{

    /**
     * @var DistributionAlgorithm
     */
    private $algorithm;

    /**
     * Set selected algorithm
     *
     * @param DistributionAlgorithm $algorithm
     *
     * @return DistributionService
     */
    public function setAlgorithm(DistributionAlgorithm $algorithm): self
    {
        $this->algorithm = $algorithm;

        return $this;
    }

    /**
     * Get algorithm
     *
     * @return DistributionAlgorithm
     */
    public function getAlgorithm(): ?DistributionAlgorithm
    {
        return $this->algorithm;
    }

    /**
     * Get user id
     *
     * @param array       $users
     *
     * @param string|null $group
     *
     * @return mixed
     */
    public function getUserId(array $users, string $group = null)
    {
        if (($alg = $this->getAlgorithm()) !== null) {
            return $alg->getUserId($users, $group);
        }

        return null;
    }
}