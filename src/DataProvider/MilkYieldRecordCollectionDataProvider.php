<?php

namespace App\DataProvider;

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
     * MilkYieldRecordCollectionDataProvider constructor.
     * @param MilkYieldRecordDataRepository $repository
     */
    public function __construct(MilkYieldRecordDataRepository $repository)
    {
        $this->repository = $repository;
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

        return $collection;
    }
}