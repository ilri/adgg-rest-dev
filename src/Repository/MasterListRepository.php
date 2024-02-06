<?php

namespace App\Repository;

use App\Entity\MasterList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MasterListRepository extends ServiceEntityRepository
{
    /**
     * MasterListRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MasterList::class);
    }

    public function findActiveMasterLists()
    {
        return $this->createQueryBuilder('ml')
            ->andWhere('ml.isActive = :isActive')
            ->setParameter('isActive', true)
            ->getQuery()
            ->getResult();
    }
}