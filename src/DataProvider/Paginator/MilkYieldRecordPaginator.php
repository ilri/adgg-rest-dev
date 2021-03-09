<?php

namespace App\DataProvider\Paginator;

use ApiPlatform\Core\DataProvider\PaginatorInterface;
use App\Repository\MilkYieldRecordCachedDataRepository;
use App\Repository\MilkYieldRecordDataRepository;

class MilkYieldRecordPaginator implements PaginatorInterface, \IteratorAggregate
{
    /**
     * @var MilkYieldRecordDataRepository
     */
    private $repository;

    /**
     * @var MilkYieldRecordCachedDataRepository
     */
    private $cachedRepository;

    /**
     * @var int
     */
    private $currentPage;

    /**
     * @var int
     */
    private $maxResults;

    /**
     * MilkYieldRecordPaginator constructor.
     * @param MilkYieldRecordDataRepository $repository
     * @param MilkYieldRecordCachedDataRepository $cachedRepository
     * @param int $currentPage
     * @param int $maxResults
     */
    public function __construct(MilkYieldRecordDataRepository $repository, MilkYieldRecordCachedDataRepository $cachedRepository, int $currentPage, int $maxResults)
    {
        $this->repository = $repository;
        $this->cachedRepository = $cachedRepository;
        $this->currentPage = $currentPage;
        $this->maxResults = $maxResults;
    }

    /**
     * @return float
     */
    public function getLastPage(): float
    {
        return ceil($this->getTotalItems() / $this->getItemsPerPage()) ?: 1.;
    }

    /**
     * @return float
     */
    public function getTotalItems(): float
    {
        return $this->repository->countAllMilkYieldRecords();
    }

    /**
     * @return float
     */
    public function getCurrentPage(): float
    {
        return $this->currentPage;
    }

    /**
     * @return float
     */
    public function getItemsPerPage(): float
    {
        return $this->maxResults;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->getTotalItems();
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->cachedRepository->getMilkYieldRecords($this->currentPage));
    }
}
