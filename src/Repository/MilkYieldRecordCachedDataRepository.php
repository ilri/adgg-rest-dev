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
     * @param int $page
     * @return array<int, MilkYieldRecord>
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getMilkYieldRecords(int $page = 1): array
    {
        return $this->cache->get(sprintf('milk_yield_records_%s', $page), function () use ($page) {
            return $this->repository->getMilkYieldRecords($page);
        });
    }

    /**
     * @param int $eventId
     * @return MilkYieldRecord
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getMilkYieldRecord(int $eventId): MilkYieldRecord
    {
        return $this->cache->get(sprintf('milk_yield_record_id_%s', $eventId), function() use ($eventId) {
            $this->repository->getMilkYieldRecord($eventId);
        });
    }

    /**
     * @return int
     */
    public function countAllMilkYieldRecords(): int
    {
        return $this->repository->countAllMilkYieldRecords();
    }
}