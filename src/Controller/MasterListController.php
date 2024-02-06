<?php

// src/Controller/MasterListController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\MasterList;

class MasterListController extends AbstractController
{

    /**
     * @Route("/api/master_lists", name="get_active_master_lists", methods={"GET"})
     */
    public function getActiveMasterLists(SerializerInterface $serializer)
    {
        $repository = $this->getDoctrine()->getRepository(MasterList::class);

        // Use the custom repository method to retrieve only active MasterLists
        $activeMasterLists = $repository->findActiveMasterLists();

        // Use Symfony Serializer to convert entities to array
        $serializedMasterLists = $serializer->normalize($activeMasterLists, null, [AbstractNormalizer::IGNORED_ATTRIBUTES => ['masterList']]);

        // Return the serialized data as a JSON response
        return new JsonResponse($serializedMasterLists);
    }

}

