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

    /**
     * Get all records from the table auth_users where the column
     * additional_attributes has a key "728" which is not NULL or
     * not an array containing an empty string.
     *
     * These are excluded:
     * {"728": NULL}
     * {"728": [""]}
     *
     * @param $key
     * @return User[]
     */
    public function findAllUsersWithAdditionalAttributeKey($key): array
    {
        $rsm = $this->createResultSetMappingBuilder('u');
        $rsm->addRootEntityFromClassMetadata(User::class, 'u');
        $sql = sprintf('
            SELECT %s FROM auth_users AS u
            WHERE
                JSON_EXTRACT(u.additional_attributes, \'$."%s"\') IS NOT NULL
            AND JSON_EXTRACT(u.additional_attributes, \'$."%s"[0]\') != ""
        ', $rsm->generateSelectClause(), $key, $key);
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
        return $query->getResult();
    }
}