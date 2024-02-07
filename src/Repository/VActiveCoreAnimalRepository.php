<?php

namespace App\Repository;

use App\Entity\VActiveCoreAnimal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VActiveCoreAnimal>
 *
 * @method VActiveCoreAnimal|null find($id, $lockMode = null, $lockVersion = null)
 * @method VActiveCoreAnimal|null findOneBy(array $criteria, array $orderBy = null)
 * @method VActiveCoreAnimal[]    findAll()
 * @method VActiveCoreAnimal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VActiveCoreAnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VActiveCoreAnimal::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(VActiveCoreAnimal $entity, bool $flush = true): void
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
    public function remove(VActiveCoreAnimal $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return VActiveCoreAnimal[] Returns an array of VActiveCoreAnimal objects
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
    public function findOneBySomeField($value): ?VActiveCoreAnimal
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
