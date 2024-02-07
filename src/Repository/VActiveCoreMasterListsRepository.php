<?php

namespace App\Repository;

use App\Entity\VActiveCoreMasterLists;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VActiveCoreMasterLists>
 *
 * @method VActiveCoreMasterLists|null find($id, $lockMode = null, $lockVersion = null)
 * @method VActiveCoreMasterLists|null findOneBy(array $criteria, array $orderBy = null)
 * @method VActiveCoreMasterLists[]    findAll()
 * @method VActiveCoreMasterLists[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VActiveCoreMasterListsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VActiveCoreMasterLists::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(VActiveCoreMasterLists $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(VActiveCoreMasterLists $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return VActiveCoreMasterLists[] Returns an array of VActiveCoreMasterLists objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VActiveCoreMasterLists
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
