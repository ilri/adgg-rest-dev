<?php

declare(strict_types=1);

namespace App\DataProvider\Extension;

use App\Entity\MilkYieldRecord;

interface MilkYieldRecordCollectionExtensionInterface
{
    /**
     * Returns the final result object.
     *
     * @param array<int, MilkYieldRecord> $collection
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array<string, mixed> $context
     *
     * @return iterable<MilkYieldRecord>
     */
    public function getResult(array $collection, string $resourceClass, string $operationName = null, array $context = []): iterable;

    /**
     * Tells if the extension is enabled or not.
     *
     * @param string|null $resourceClass
     * @param string|null $operationName
     * @param array<string, mixed> $context
     * @return bool
     */
    public function isEnabled(string $resourceClass = null, string $operationName = null, array $context = []): bool;
}