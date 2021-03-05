<?php

namespace App\Repository;

use App\Entity\AnimalEvent;
use Carbon\Carbon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class AnimalEventRepository extends ServiceEntityRepository
{
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

    /**
     * @return AnimalEvent[]
     */
    public function findAllCalvingEvents(): array
    {
        $queryBuilder = $this->createQueryBuilder('a');

        return $this->addCalvingEventQueryBuilder($queryBuilder)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return AnimalEvent[]
     */
    public function findAllMilkingEvents(): array
    {
        $queryBuilder = $this->createQueryBuilder('a');

        return $this->addMilkingEventQueryBuilder($queryBuilder)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param int $id
     * @return null|AnimalEvent
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByMilkingEvent(int $id): ?AnimalEvent
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
        $milkingEvent = $this->findOneByMilkingEvent($id);

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
     * @param int $id
     * @return int
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findDIMForMilkingEvent(int $id): int
    {
        $milkingEvent = $this->findOneByMilkingEvent($id);
        $calvingEvent = $this->findLactationForMilkingEvent($id);

        $milkingEventDate = Carbon::parse($milkingEvent->getEventDate()->format('Y-m-d'));
        $calvingEventDate = Carbon::parse($calvingEvent->getEventDate()->format('Y-m-d'));

        return $milkingEventDate->diffInDays($calvingEventDate);
    }

    /**
     * @param int $id
     * @return array
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findEMYForMilkingEvent(int $id): array
    {
        $dim = $this->findDIMForMilkingEvent($id);
        $exponent = -0.0017 * $dim;
        $emy = 8.11 * pow($dim, 0.068) * exp($exponent);

        return [
            'emy' => $emy,
            'TU' => $emy + 2.3,
            'TL' => $emy - 2.3
        ];
    }
}