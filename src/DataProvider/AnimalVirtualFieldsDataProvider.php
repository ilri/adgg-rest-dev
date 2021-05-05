<?php


namespace App\DataProvider;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use ApiPlatform\Core\DataProvider\{
    CollectionDataProviderInterface,
    ContextAwareCollectionDataProviderInterface,
    RestrictedDataProviderInterface
};


class AnimalVirtualFieldsDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{

    /**
     * @var AnimalRepository
     */
    private $repository;
    /**
     * @var CollectionDataProviderInterface
     */
    private $collectionDataProvider;

    /**
     * AnimalVirtualFieldsDataProvider constructor.
     * @param CollectionDataProviderInterface $collectionDataProvider
     * @param AnimalRepository $repository
     */
    public function __construct(CollectionDataProviderInterface $collectionDataProvider, AnimalRepository $repository)
    {
        $this->collectionDataProvider = $collectionDataProvider;
        $this->repository = $repository;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return iterable
     * @throws \ApiPlatform\Core\Exception\ResourceClassNotSupportedException
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $animalEntityResources = $this->collectionDataProvider->getCollection($resourceClass, $operationName, $context);

        foreach ($animalEntityResources as $animalEntity) {
            $daysSinceLastCalving = $this->repository->getDaysSinceLastCalvingEvent($animalEntity->getId());
            $animalEntity->setDaysSinceLastCalvingEvent($daysSinceLastCalving);
        }

        return $animalEntityResources;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass == Animal::class;
    }
}
