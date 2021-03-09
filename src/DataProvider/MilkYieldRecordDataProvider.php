<?php

namespace App\DataProvider;

use App\DataProvider\Paginator\MilkYieldRecordPaginator;
use ApiPlatform\Core\DataProvider\{
    ItemDataProviderInterface,
    Pagination,
    RestrictedDataProviderInterface,
    ContextAwareCollectionDataProviderInterface
};
use ApiPlatform\Core\Exception\InvalidIdentifierException;
use App\Entity\MilkYieldRecord;
use App\Repository\MilkYieldRecordDataRepository;

final class MilkYieldRecordDataProvider implements ContextAwareCollectionDataProviderInterface, ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var MilkYieldRecordDataRepository
     */
    private $repository;

    /**
     * @var Pagination
     */
    private $pagination;

    /**
     * MilkYieldRecordCollectionDataProvider constructor.
     * @param MilkYieldRecordDataRepository $repository
     * @param Pagination $pagination
     */
    public function __construct(MilkYieldRecordDataRepository $repository, Pagination $pagination)
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