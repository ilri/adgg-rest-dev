<?php

namespace App\Repository;

use App\Entity\BreedMatrix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BreedMatrix|null find($id, $lockMode = null, $lockVersion = null)
 * @method BreedMatrix|null findOneBy(array $criteria, array $orderBy = null)
 * @method BreedMatrix[]    findAll()
 * @method BreedMatrix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BreedMatrixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BreedMatrix::class);
    }

    // /**
    //  * @return BreedMatrix[] Returns an array of BreedMatrix objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BreedMatrix
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
