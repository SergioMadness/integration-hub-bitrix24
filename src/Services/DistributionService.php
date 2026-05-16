<?php

declare(strict_types=1);

namespace professionalweb\IntegrationHub\Bitrix24\Services;

use professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Interfaces\DistributionAlgorithm;
use professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Interfaces\DistributionService as IDistributionService;

/**
 * Service to distribute leads between users
 * @package professionalweb\IntegrationHub\Bitrix24\Services
 */
class DistributionService implements IDistributionService
{

    private DistributionAlgorithm $algorithm;

    /**
     * Get user id
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
     * Set selected algorithm
     *
     * @return DistributionService
     */
    public function setAlgorithm(DistributionAlgorithm $algorithm): self
    {
        $this->algorithm = $algorithm;

        return $this;
    }
}