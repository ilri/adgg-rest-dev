<?php

// src/Controller/FarmController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Farm;

class FarmController extends AbstractController
{
    /**
     * @Route("/api/farms", name="get_active_farms", methods={"GET"})
     */
    public function getActiveFarms(SerializerInterface $serializer)
    {
        $repository = $this->getDoctrine()->getRepository(Farm::class);

        // Use the custom repository method to retrieve only active Farms
        $activeFarms = $repository->findActiveFarm();

        // Use Symfony Serializer to convert entities to array
        $serializedFarms = $serializer->normalize($activeFarms, null, [AbstractNormalizer::IGNORED_ATTRIBUTES => ['farm']]);

        // Return the serialized data as a JSON response
        return new JsonResponse($serializedFarms);
    }
}
