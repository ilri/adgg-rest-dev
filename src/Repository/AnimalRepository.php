<?php

namespace App\Repository;

use App\Entity\Animal;
use Carbon\Carbon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\{
    NonUniqueResultException,
    NoResultException,
    QueryBuilder
};
use Doctrine\Persistence\ManagerRegistry;

/**
 * @see https://symfonycasts.com/screencast/symfony-doctrine/more-queries
 * @see https://symfonycasts.com/screencast/symfony4-doctrine/repository
 */
class AnimalRepository extends ServiceEntityRepository
{
    const MAX_CALVING_INTERVAL = 365;
    const MAX_LACTATION_LENGTH = 400;

    /**
     * @var AnimalEventRepository
     */
    private $animalEventRepository;

    /**
     * AnimalRepository constructor.
     * @param ManagerRegistry $registry
     * @param AnimalEventRepository $animalEventRepository
     */
    public function __construct(ManagerRegistry $registry, AnimalEventRepository $animalEventRepository)
    {
        parent::__construct($registry, Animal::class);
        $this->animalEventRepository = $animalEventRepository;
    }

    /**
     * @param int $animalId
     * @return int|null
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getDaysSinceLastCalving(int $animalId): ?int
    {
        $lastCalving = $this->animalEventRepository->findLastCalvingEventForAnimal($animalId);

        if ($lastCalving) {
            return Carbon::now()->diff($lastCalving->getEventDate())->days;
        }

        return null;
    }

    /**
     * @param int $animalId
     * @return bool
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getCalvingInterval(int $animalId): bool
    {
        $daysSinceLastCalving = $this->getDaysSinceLastCalving($animalId);
        if ($daysSinceLastCalving && $daysSinceLastCalving > self::MAX_CALVING_INTERVAL) {
            return true;
        }
        return false;
    }

    /**
     * @param int $animalId
     * @return bool
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getLactationLength(int $animalId): bool
    {
        $daysSinceLastCalving = $this->getDaysSinceLastCalving($animalId);
        if ($daysSinceLastCalving && $daysSinceLastCalving > self::MAX_LACTATION_LENGTH) {
            return true;
        }
        return false;
    }
}
