<?php

namespace App\Controller;

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
}
