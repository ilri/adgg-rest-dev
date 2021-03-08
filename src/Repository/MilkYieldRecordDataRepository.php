<?php

namespace App\Repository;

use App\Entity\{
    AnimalEvent,
    MilkYieldRecord
};
use Carbon\Carbon;

class MilkYieldRecordDataRepository implements MilkYieldRecordDataInterface
{
    /**
     * @var AnimalEventRepository
     */
    private $animalEventRepository;

    /**
     * MilkYieldRecordDataRepository constructor.
     * @param AnimalEventRepository $animalEventRepository
     */
    public function __construct(AnimalEventRepository $animalEventRepository)
    {
        $this->animalEventRepository = $animalEventRepository;
    }

    /**
     * @param int $page
     * @return array
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getMilkYieldRecords(int $page = 1): array
    {
        $milkYieldRecords = [];
        $milkingEvents = $this->animalEventRepository->findAllMilkingEvents($page);
        foreach ($milkingEvents as $milkingEvent) {
            $eventId = $milkingEvent->getId();
            $milkYieldRecords[] = $this->getMilkYieldRecord($eventId);
        }

        return $milkYieldRecords;
    }

    /**
     * @param int $eventId
     * @return MilkYieldRecord
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getMilkYieldRecord(int $eventId): MilkYieldRecord
    {
        $milkingEvent = $this->animalEventRepository->findOneMilkingEventById($eventId);
        $dim = $this->getDIMForMilkingEvent($eventId);
        $emy = $this->getEMYForMilkingEvent($eventId);
        $totalMilkRecord = $this->getTotalMilkRecord($milkingEvent);
        $feedback = $this->getFeedbackForFarmer($totalMilkRecord, $emy);
        $calvingDate = $this->animalEventRepository->findLactationForMilkingEvent($eventId)->getEventDate();
        // TODO: try to use the setters and get rid of constructor
        return new MilkYieldRecord(
            $eventId,
            $milkingEvent->getAnimal()->getId(),
            $milkingEvent->getAnimal()->getFarm()->getId(),
            $milkingEvent->getLactationId(),
            $dim,
            $totalMilkRecord,
            $emy['EMY'],
            $emy['TU'],
            $emy['TL'],
            $feedback,
            $calvingDate,
            $milkingEvent->getEventDate()
        );
    }

    /**
     * @param int $id
     * @return int
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getDIMForMilkingEvent(int $id): int
    {
        $milkingEvent = $this->animalEventRepository->findOneMilkingEventById($id);
        $calvingEvent = $this->animalEventRepository->findLactationForMilkingEvent($id);

        $milkingEventDate = Carbon::parse($milkingEvent->getEventDate()->format('Y-m-d'));
        $calvingEventDate = Carbon::parse($calvingEvent->getEventDate()->format('Y-m-d'));

        return $milkingEventDate->diffInDays($calvingEventDate);
    }

    /**
     * @param int $id
     * @return array
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getEMYForMilkingEvent(int $id): array
    {
        $dim = $this->getDIMForMilkingEvent($id);
        $exponent = -0.0017 * $dim;
        $emy = 8.11 * pow($dim, 0.068) * exp($exponent);

        return [
            'EMY' => $emy,
            'TU' => $emy + 2.3,
            'TL' => $emy - 2.3
        ];
    }

    /**
     * @param AnimalEvent $milkingEvent
     * @return float|null
     */
    public function getTotalMilkRecord(AnimalEvent $milkingEvent): ?float
    {
        $additionalAttributes = $milkingEvent->getAdditionalAttributes();
        $morning = $additionalAttributes['59'];
        $evening = $additionalAttributes['61'];
        $midday = $additionalAttributes['68'] ?? 0;

        return $morning + $evening + $midday;
    }

    /**
     * @param float $milkRecord
     * @param array $emy
     * @return string
     */
    public function getFeedbackForFarmer(float $milkRecord, array $emy): string
    {
        if ($milkRecord > $emy['TU']) {
            return 'NOTE';
        } elseif ($milkRecord < $emy['TL']) {
            return 'ALARM';
        } else {
            return '';
        }
    }
}
