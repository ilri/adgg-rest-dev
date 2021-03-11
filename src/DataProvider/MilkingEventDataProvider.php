<?php


namespace App\DataProvider;

use App\Entity\AnimalEvent;
use App\Entity\MilkYieldRecord;
use ApiPlatform\Core\DataProvider\{
    CollectionDataProviderInterface,
    ContextAwareCollectionDataProviderInterface,
    RestrictedDataProviderInterface
};


class MilkingEventDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var CollectionDataProviderInterface
     */
    private $collectionDataProvider;

    /**
     * MilkingEventDataProvider constructor.
     * @param CollectionDataProviderInterface $collectionDataProvider
     */
    public function __construct(CollectionDataProviderInterface $collectionDataProvider)
    {
        $this->collectionDataProvider = $collectionDataProvider;
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        /** @var AnimalEvent[] $milkingEvents */
        $milkingEvents = $this->collectionDataProvider->getCollection($resourceClass, $operationName, $context);

        foreach ($milkingEvents as $milkingEvent) {
            $milkYieldRecord = new MilkYieldRecord();
            $milkYieldRecord->setId($milkingEvent->getId());
            $milkYieldRecord->setMilkingDate($milkingEvent->getEventDate());
            $milkingEvent->setMilkYieldRecord($milkYieldRecord);
        }

        return $milkingEvents;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return AnimalEvent::class == $resourceClass && 'milking_events' == $operationName;
    }
}