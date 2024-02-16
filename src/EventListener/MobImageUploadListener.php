<?php

namespace App\EventListener;

use App\EventSubscriber\MobImageSubscriber;
use App\Entity\MobImages;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;

class MobImageUploadListener
{
    private $entityManager;
    private $filesystem;

    public function __construct(EntityManagerInterface $entityManager, Filesystem $filesystem)
    {
        $this->entityManager = $entityManager;
        $this->filesystem = $filesystem;
    }

    public function onImageUpload(MobImageSubscriber $event)
    {
        $uploadedFile = $event->getUploadedFile();

        // Generate a unique filename or use original name
        $filename = md5(uniqid()) . '.' . $uploadedFile->guessExtension();

        // Define the directory where you want to store the uploaded files
        $uploadDirectory = 'src/Images';

        // Move the uploaded file to the specified directory
        $this->filesystem->copy($uploadedFile->getPathname(), $uploadDirectory . '/' . $filename, true);

        // Handle file storage and entity persistence logic
        $mobImage = new MobImages();
        $mobImage->setImageName($filename); // Store the generated filename

        $this->entityManager->persist($mobImage);
        $this->entityManager->flush();
    }
}
