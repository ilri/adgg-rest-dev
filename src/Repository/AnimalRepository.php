<?php

namespace App\Repository;

use App\Entity\Animal;
use Carbon\Carbon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @see https://symfonycasts.com/screencast/symfony-doctrine/more-queries
 * @see https://symfonycasts.com/screencast/symfony4-doctrine/repository
 */
class AnimalRepository extends ServiceEntityRepository
{
    /**
     * AnimalRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    public function findAnimalWithFarmById(int $animalId)
    {
        return $this->createQueryBuilder('a')
            ->select('a', 'f') // Select both Animal and Farm
            ->innerJoin('a.farm', 'f') // Doctrine infers the join condition from the association mapping
            ->where('a.id = :animalId')
            ->setParameter('animalId', $animalId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
