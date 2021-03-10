<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\{ContextAwareCollectionDataProviderInterface,
    ItemDataProviderInterface,
    Pagination,
    RestrictedDataProviderInterface};
use ApiPlatform\Core\Exception\InvalidIdentifierException;
use App\DataProvider\Paginator\MilkYieldRecordPaginator;
use App\Entity\MilkYieldRecord;
use App\Repository\MilkYieldRecordCachedDataRepository;

final class MilkYieldRecordDataProvider implements ContextAwareCollectionDataProviderInterface, ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var MilkYieldRecordCachedDataRepository
     */
    private $repository;

    /**
     * @var Pagination
     */
    private $pagination;

    /**
     * MilkYieldRecordCollectionDataProvider constructor.
     * @param MilkYieldRecordCachedDataRepository $repository
     * @param Pagination $pagination
     */
    public function __construct(MilkYieldRecordCachedDataRepository $repository, Pagination $pagination)
    {
        $this->repository = $repository;
        $this->pagination = $pagination;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return MilkYieldRecord::class == $resourceClass;
    }

    /**
     * @inheritDoc
     * @throws InvalidIdentifierException
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if (!is_int($id)) {
            throw new InvalidIdentifierException('Invalid id key type.');
        }

        try {
            return $this->repository->getMilkYieldRecord($id);
        } catch (\Exception $e) {
            throw new \RuntimeException(sprintf('Unable to retrieve milk yield record: %s', $e->getMessage()));
        }
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): MilkYieldRecordPaginator
    {
        $page = $context['filters']['page'];

        [, , $limit] = $this->pagination->getPagination($resourceClass, $operationName);

        return new MilkYieldRecordPaginator(
            $this->repository,
            $page,
            $limit
        );
    }
}