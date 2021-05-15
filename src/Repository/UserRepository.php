<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    /**
     * UserRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @return User[]
     */
    public function findAllUsersWithAdditionalAttributes(): array
    {
        return $this
            ->createQueryBuilder('u')
            ->where('u.additionalAttributes IS NOT NULL')
            ->getQuery()
            ->getResult()
        ;
    }
}