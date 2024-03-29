<?php

namespace App\Repository;

use App\Entity\MobFormFieldMultiple;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MobFormFieldMultiple>
 *
 * @method MobFormFieldMultiple|null find($id, $lockMode = null, $lockVersion = null)
 * @method MobFormFieldMultiple|null findOneBy(array $criteria, array $orderBy = null)
 * @method MobFormFieldMultiple[]    findAll()
 * @method MobFormFieldMultiple[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MobFormFieldMultipleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MobFormFieldMultiple::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(MobFormFieldMultiple $entity, bool $flush = true): void
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
    public function remove(MobFormFieldMultiple $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return MobFormFieldMultiple[] Returns an array of MobFormFieldMultiple objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MobFormFieldMultiple
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
