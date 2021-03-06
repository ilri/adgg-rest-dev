<?php

namespace App\Controller;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;
use App\Repository\AnimalEventRepository;
use Symfony\Component\HttpFoundation\Request;

class MilkingEventController
{
    public function __invoke(Request $request, AnimalEventRepository $animalEventRepository): Paginator
    {
        $page = (int) $request->query->get('page', 1);
        return $animalEventRepository->findAllMilkingEvents($page);
    }
}