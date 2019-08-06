<?php namespace professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Algorithms;

use Illuminate\Support\Facades\Cache;
use professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Interfaces\DistributionAlgorithm;

/**
 * Round robin implementation
 * @package professionalweb\IntegrationHub\Bitrix24\Bitrix24LeadDistribution\Algorithms
 */
class RoundRobin implements DistributionAlgorithm
{
    /**
     * Get map user->leadQty
     *
     * @param string $key
     *
     * @return array
     */
    protected function getMap(string $key): array
    {
        $map = Cache::get('rr_map_' . $key, [
            'values' => [],
            'date'   => date('d.m.Y'),
        ]);
        if ($map['date'] !== date('d.m.Y')) {
            $map['values'] = [];
        }

        return $map['values'];
    }

    /**
     * Remember map
     *
     * @param string $key
     * @param array  $map
     *
     * @return RoundRobin
     */
    protected function setMap(string $key, array $map): self
    {
        Cache::forever('rr_map_' . $key, [
            'values' => $map,
            'date'   => date('d.m.Y'),
        ]);

        return $this;
    }

    /**
     * Get user id
     *
     * @param array  $ids
     *
     * @param string $group
     *
     * @return mixed
     */
    public function getUserId(array $ids, ?string $group = null)
    {
        $key = $group ?? md5(implode('', array_sort($ids)));
        $map = $this->getMap($key);

        \Log::info('Map: ' . $key, $map);

        $result = null;
        $minQty = null;
        foreach ($ids as $id) {
            if (!isset($map[$id])) {
                $result = $id;
                $map[$id] = 0;
                break;
            }

            if ($minQty === null || $minQty > $map[$id]) {
                $minQty = $map[$id];
                $result = $id;
            }
        }
        if ($result !== null) {
            $map[$result] = $map[$result] ?? 0;
            $map[$result]++;
        }

        $this->setMap($key, $map);
        \Log::info('Set map: ' . $key, $map);

        return $result;
    }
}