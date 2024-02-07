<?php

namespace App\Repository;

use App\Entity\VActiveCoreFarm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VActiveCoreFarm>
 *
 * @method VActiveCoreFarm|null find($id, $lockMode = null, $lockVersion = null)
 * @method VActiveCoreFarm|null findOneBy(array $criteria, array $orderBy = null)
 * @method VActiveCoreFarm[]    findAll()
 * @method VActiveCoreFarm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VActiveCoreFarmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VActiveCoreFarm::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(VActiveCoreFarm $entity, bool $flush = true): void
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
    public function remove(VActiveCoreFarm $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return VActiveCoreFarm[] Returns an array of VActiveCoreFarm objects
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
    public function findOneBySomeField($value): ?VActiveCoreFarm
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
