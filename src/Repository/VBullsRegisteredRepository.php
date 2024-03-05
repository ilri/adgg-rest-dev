<?php

namespace App\Repository;

use App\Entity\VBullsRegistered;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VBullsRegistered>
 *
 * @method VBullsRegistered|null find($id, $lockMode = null, $lockVersion = null)
 * @method VBullsRegistered|null findOneBy(array $criteria, array $orderBy = null)
 * @method VBullsRegistered[]    findAll()
 * @method VBullsRegistered[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VBullsRegisteredRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VBullsRegistered::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(VBullsRegistered $entity, bool $flush = true): void
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
    public function remove(VBullsRegistered $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return VBullsRegistered[] Returns an array of VBullsRegistered objects
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
    public function findOneBySomeField($value): ?VBullsRegistered
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
