<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\MilkYieldRecord;
use Symfony\Contracts\Cache\CacheInterface;

final class MilkYieldRecordCachedDataRepository implements MilkYieldRecordDataInterface
{
    /**
     * @var MilkYieldRecordDataRepository
     */
    private $repository;

    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * MilkYieldRecordCachedDataRepository constructor.
     * @param MilkYieldRecordDataRepository $repository
     * @param CacheInterface $cache
     */
    public function __construct(MilkYieldRecordDataRepository $repository, CacheInterface $cache)
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }

    /**
     * @param int $eventId
     * @return MilkYieldRecord
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getMilkYieldRecord(int $eventId): MilkYieldRecord
    {
        return $this->cache->get(sprintf('milk_yield_record_id_%s', $eventId), function () use ($eventId) {
            return $this->repository->getMilkYieldRecord($eventId);
        });
    }

}