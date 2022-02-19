<?php

namespace App\Repository;

use App\Entity\MasterListType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MasterListTypeRepository extends ServiceEntityRepository
{
    /**
     * MasterListTypeRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MasterListType::class);
    }
}