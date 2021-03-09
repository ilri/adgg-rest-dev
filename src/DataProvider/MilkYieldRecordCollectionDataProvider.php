<?php

namespace App\DataProvider;

use App\DataProvider\Extension\MilkYieldRecordPaginationExtension;
use App\Entity\MilkYieldRecord;
use App\Repository\MilkYieldRecordDataRepository;
use ApiPlatform\Core\DataProvider\{
    ContextAwareCollectionDataProviderInterface,
    RestrictedDataProviderInterface
};

final class MilkYieldRecordCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var MilkYieldRecordDataRepository
     */
    private $repository;

    /**
     * @var MilkYieldRecordPaginationExtension
     */
    private $paginationExtension;

    /**
     * MilkYieldRecordCollectionDataProvider constructor.
     * @param MilkYieldRecordDataRepository $repository
     * @param MilkYieldRecordPaginationExtension $paginationExtension
     */
    public function __construct(MilkYieldRecordDataRepository $repository, MilkYieldRecordPaginationExtension $paginationExtension)
    {
        $this->repository = $repository;
        $this->paginationExtension = $paginationExtension;
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
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $page = $context['filters']['page'];

        try {
            $collection = $this->repository->getMilkYieldRecords($page);
        } catch (\Exception $e) {
            throw new \RuntimeException(sprintf('Unable to retrieve top books from external source: %s', $e->getMessage()));
        }

        if (!$this->paginationExtension->isEnabled($resourceClass, $operationName, $context)) {
            return $collection;
        }

        return $this->paginationExtension->getResult($collection, $resourceClass, $operationName, $context);
    }
}