<?php

namespace App\Repository;

use App\Entity\AnimalEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\{
    NonUniqueResultException,
    NoResultException,
    QueryBuilder
};
use Doctrine\Persistence\ManagerRegistry;

/**
 * @see https://symfonycasts.com/screencast/symfony-doctrine/more-queries
 * @see https://symfonycasts.com/screencast/symfony4-doctrine/repository
 */
class AnimalEventRepository extends ServiceEntityRepository
{
    const ITEMS_PER_PAGE = 30;

    /**
     * AnimalEventRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnimalEvent::class);
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @return QueryBuilder
     */
    private function addCalvingEventQueryBuilder(QueryBuilder $queryBuilder): QueryBuilder
    {
        return $queryBuilder
            ->andWhere('a.eventType = :eventType')
            ->setParameter('eventType', AnimalEvent::EVENT_TYPE_CALVING)
        ;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @return QueryBuilder
     */
    private function addMilkingEventQueryBuilder(QueryBuilder $queryBuilder): QueryBuilder
    {
        return $queryBuilder
            ->andWhere('a.eventType = :eventType')
            ->setParameter('eventType', AnimalEvent::EVENT_TYPE_MILKING)
        ;
    }

    public function countAllMilkingEvents(): int
    {
        $queryBuilder = $this->createQueryBuilder('a');

        return $this->addMilkingEventQueryBuilder($queryBuilder)
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /**
     * @param int $id
     * @return AnimalEvent|null
     * @throws NonUniqueResultException
     */
    public function findOneCalvingEventById(int $id): ?AnimalEvent
    {
        $queryBuilder = $this->createQueryBuilder('a');

        return $this->addCalvingEventQueryBuilder($queryBuilder)
            ->andWhere('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param int $id
     * @return null|AnimalEvent
     * @throws NonUniqueResultException
     */
    public function findOneMilkingEventById(int $id): ?AnimalEvent
    {
        $queryBuilder = $this->createQueryBuilder('a');

        return $this->addMilkingEventQueryBuilder($queryBuilder)
            ->andWhere('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param int $id
     * @return AnimalEvent|null
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function findLactationForMilkingEvent(int $id): ?AnimalEvent
    {
        $milkingEvent = $this->findOneMilkingEventById($id);

        if ($milkingEvent == null) {
            return null;
        }

        $queryBuilder = $this->createQueryBuilder('a');

        return $this->addCalvingEventQueryBuilder($queryBuilder)
            ->andWhere('a.id = :id')
            ->setParameter('id', $milkingEvent->getLactationId())
            ->getQuery()
            ->getSingleResult()
        ;
    }

    /**
     * @param int $animalId
     * @return AnimalEvent|null
     * @throws NonUniqueResultException
     */
    public function findLastCalvingEventForAnimal(int $animalId): ?AnimalEvent
    {
        $queryBuilder = $this->createQueryBuilder('a');

        return $this->addCalvingEventQueryBuilder($queryBuilder)
            ->andWhere('a.animal = :animalId')
            ->setParameter('animalId', $animalId)
            ->orderBy('a.eventDate', 'DESC')
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult()
        ;
    }
}
