<?php

namespace App\EventListener;

use App\Entity\MobImages;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MobImageListener
{
    private $entityManager;
    private $validator;

    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $request = $event->getRequest();

//        var_dump('Listener is triggered.');
//        var_dump($request->files->all());

        // Check if it's a POST request and has the required parameters
        if ($request->isMethod('POST') && $request->files->has('imageFile')) {
            var_dump('inside the if statement');
            $coreTableId = $request->request->get('coreTableId');
            $coreTableType = $request->request->get('coreTableType');

            if (!$coreTableId || !$coreTableType) {
                throw new BadRequestHttpException('Missing coreTableId or coreTableType in the request.');
            }

            // Create a new MobImages entity
            $mobImage = new MobImages();
            $mobImage->setCoreTableId($coreTableId);
            $mobImage->setCoreTableType($coreTableType);
            $mobImage->setImageFile($request->files->get('imageFile'));


            // Validate the entity
            $violations = $this->validator->validate($mobImage, null, ['upload']);

            if (count($violations) > 0) {
                // Handle validation errors
                $errors = [];
                foreach ($violations as $violation) {
                    $errors[$violation->getPropertyPath()][] = $violation->getMessage();
                }

                throw new BadRequestHttpException(json_encode($errors));
            }

            // Handle file upload
            $mobImage->uploadImageFile();

            // Persist and flush the entity
            $this->entityManager->persist($mobImage);
            $this->entityManager->flush();
        }
    }
}
