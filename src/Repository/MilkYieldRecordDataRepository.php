<?php

namespace App\Repository;

use App\Entity\{
    AnimalEvent,
    MilkYieldRecord
};
use Carbon\Carbon;

/**
 * @see https://symfonycasts.com/screencast/symfony-doctrine/more-queries
 * @see https://symfonycasts.com/screencast/symfony4-doctrine/repository
 */
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
        $calvingEvent = $this->animalEventRepository->findLactationForMilkingEvent($eventId);

        $milkYieldRecord = new MilkYieldRecord();
        $milkYieldRecord
            ->setId($eventId)
            ->setCalvingDate($calvingEvent->getEventDate())
            ->setDaysInMilk($dim)
            ->setTotalMilkRecord($totalMilkRecord)
            ->setExpectedMilkYield($emy['EMY'])
            ->setUpperLimit($emy['TU'])
            ->setLowerLimit($emy['TL'])
            ->setFeedback($feedback)
        ;

        return $milkYieldRecord;
    }

    /**
     * @param int $id
     * @return int
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    private function getDIMForMilkingEvent(int $id): int
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
    private function getEMYForMilkingEvent(int $id): array
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
    private function getTotalMilkRecord(AnimalEvent $milkingEvent): ?float
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
    private function getFeedbackForFarmer(float $milkRecord, array $emy): string
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
