<?php

namespace App\DataProvider;

use ApiPlatform\Core\Exception\InvalidIdentifierException;
use App\Repository\MilkYieldRecordDataRepository;
use ApiPlatform\Core\DataProvider\{
    ItemDataProviderInterface,
    RestrictedDataProviderInterface
};
use App\Entity\MilkYieldRecord;

final class MilkYieldRecordItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $repository;

    public function __construct(MilkYieldRecordDataRepository $repository)
    {
        $this->repository = $repository;
    }

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
}