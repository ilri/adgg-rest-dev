<?php

namespace App\Controller;

use App\Entity\MobImages;
use App\Form\MobImageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MobImageController extends AbstractController
{
    /**
     * @Route("/api/images", name="mob_image", methods={"POST"})
     */
    public function createMobImage(Request $request): Response
    {
        $mobImage = new MobImages();
        $form = $this->createForm(MobImageType::class, $mobImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mobImage->uploadImageFile();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mobImage);
            $entityManager->flush();

            return $this->json(['message' => 'Image uploaded successfully'], Response::HTTP_CREATED);
        }

        // If the form is not valid, gather validation errors
        $errors = [];
        foreach ($form->getErrors(true, true) as $error) {
            $errors[] = $error->getMessage();
        }

        return $this->json(['message' => 'Invalid form data', 'errors' => $errors], Response::HTTP_BAD_REQUEST);
    }

}

