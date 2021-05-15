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

    public function findAllUsersWithAdditionalAttributeKey(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT u.id, u.additional_attributes FROM auth_users AS u
            WHERE JSON_EXTRACT(u.additional_attributes, \'$."728"\') IS NOT NULL
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAllKeyValue();
    }
}