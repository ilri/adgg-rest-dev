<?php

namespace App\Repository;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;
use App\Entity\AnimalEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

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
     * @return null|AnimalEvent
     * @throws \Doctrine\ORM\NonUniqueResultException
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
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
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
}
