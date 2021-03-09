<?php

namespace App\DataProvider\Paginator;

use ApiPlatform\Core\DataProvider\PaginatorInterface;
use App\Repository\MilkYieldRecordDataRepository;

class MilkYieldRecordPaginator implements PaginatorInterface, \IteratorAggregate
{
    /**
     * @var MilkYieldRecordDataRepository
     */
    private $repository;

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
     * @param int $currentPage
     * @param int $maxResults
     */
    public function __construct(MilkYieldRecordDataRepository $repository, int $currentPage, int $maxResults)
    {
        $this->repository = $repository;
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
        return new \ArrayIterator($this->repository->getMilkYieldRecords($this->currentPage));
    }
}
