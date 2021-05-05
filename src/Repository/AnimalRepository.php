<?php

namespace App\Repository;

use App\Entity\Animal;
use Carbon\Carbon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\{
    NonUniqueResultException,
    NoResultException,
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
    public function getDaysSinceLastCalvingEvent(int $animalId): ?int
    {
        $lastCalvingEvent = $this->animalEventRepository->findLastCalvingEventForAnimal($animalId);

        if ($lastCalvingEvent) {
            return Carbon::now()->diff($lastCalvingEvent->getEventDate())->days;
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
        return $this->getDaysSinceLastCalvingEvent($animalId) > self::MAX_CALVING_INTERVAL;
    }

    /**
     * @param int $animalId
     * @return bool
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getLactationLength(int $animalId): bool
    {
        return $this->getDaysSinceLastCalvingEvent($animalId) > self::MAX_LACTATION_LENGTH;
    }
}
