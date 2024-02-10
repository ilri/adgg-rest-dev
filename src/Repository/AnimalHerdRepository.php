<?php

namespace App\Repository;

use App\Entity\Herd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AnimalHerdRepository extends ServiceEntityRepository
{
    /**
     * AnimalRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Herd::class);
    }
}