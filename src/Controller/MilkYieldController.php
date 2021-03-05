<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\AnimalEvent;

class MilkYieldController extends AbstractController
{

    /**
     * @Route("/milk/yield", name="milk_yield")
     */
    public function getUpperLimitToleranceZoneMilkYield(){

        // 8.11* (DIM^0.068)*𝑒^(−0.0017*DIM) +2.3
        $animal_event = new AnimalEvent();
        $event_type = $animal_event->getEventType();
        $event_date = $animal_event->getCreatedAt();

        if ($event_type = 1) {
            $calving_date = $event_date;
        }
        if ($event_type = 2) {
            $milking_date = $event_date;
        }
        $DIM = date_diff($milking_date, $calving_date);

        $milk_yield = 8.11 * (pow($DIM,0.068))*exp(-0.0017*$DIM) +2.3;

        return $milk_yield;
    }

    public function __invoke($data)
    {
        return $data;
    }

    /**
     * @Route("/dim", name="milk_yield")
     * @return Response
     */
    public function actionDIMValues(AnimalRepository $animalRepository):  Response
    {
        $dimValues = $animalRepository->calculateAllDIMValuesForAnimal(214644);

        $milkingEvents = $animalRepository->findAllMilkingEventsForAnimal(214644);

        $calvingEvents = $animalRepository->findAllCalvingEventsForAnimal(214644);

        $emyValues = $animalRepository->calculateExpectedMilkYieldForAnimal(214644);
        // dump($emyValues);

        $milkRecords = $animalRepository->compareActualMilkRecordWithExpectedMilkYield(214644);
        // dump($milkRecords);

        return new Response('get DIM values for animal 214644');
    }
}
