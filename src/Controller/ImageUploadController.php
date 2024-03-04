<?php

namespace App\Controller;

use App\Entity\MobImages;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Repository\MobImagesRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\PropertyMappingFactory;

class ImageUploadController extends AbstractController
{
    private $entityManager;
    private $vichUploaderMapping;

    public function __construct(EntityManagerInterface $entityManager,PropertyMappingFactory $vichUploaderMapping)
    {
        $this->entityManager = $entityManager;
        $this->vichUploaderMapping = $vichUploaderMapping;
    }
    /**
     * @Route("/api/images", name="api_images_upload", methods={"POST"})
     */
    public function uploadImage(Request $request, Security $security): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        // Extract necessary data from the request
        $mobDataId = $request->request->get('mobImageDataId');
        $coreTableType = $request->request->get('coreTableType');
        $imageServerLocation = $request->request->get('imageServerLocation');

        // Get the authenticated user
        $user = $this->getUser();

        // Create a new MobImages entity
        $mobImage = new MobImages();

        // Set mobDataId property
        $mobImage->setCoreTableType($coreTableType);
        $mobImage->setImageServerLocation($imageServerLocation);

        // Set createdBy based on the authenticated user
        $user = $security->getUser();
        if ($user) {
            $mobImage->setCreatedBy($user->getId());
        }

        // Set mobImageDataId and fetch coreTableId based on mobImageDataId
        $mobImageDataId = $request->request->get('mobImageDataId');
        $mobImage->setMobImageDataId($mobImageDataId);

        // Use the fetchAnimalId function to get coreTableId
        $coreTableId = $this->fetchAnimalId($mobImageDataId);
        $mobImage->setCoreTableId($coreTableId);

        // Handle image upload
        $imageFile = $request->files->get('imageFile');

        if ($imageFile) {
            $mobImage->setImageFile($imageFile);
        }

        // Determine the image server location dynamically
        $imageServerLocation = $this->determineImageServerLocation($mobImage);

        // Set the imageServerLocation property
        $mobImage->setImageServerLocation($imageServerLocation);

        // Persist the entity
        $entityManager->persist($mobImage);
        $entityManager->flush();

        return new Response('Image uploaded successfully', Response::HTTP_OK);
    }

    private function fetchAnimalId($mobAnimalDataId)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('animalId', 'animalId');

        $sql = 'SELECT fn_getAnimalID_mob(:mobAnimalDataId) as animalId';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('mobAnimalDataId', $mobAnimalDataId);

        $result = $query->getSingleResult();

        return $result['animalId'];
    }

    private function determineImageServerLocation($mobImage): string
    {
        // Get the VichUploader mapping for MobImages entity
        $mapping = $this->vichUploaderMapping->fromField($mobImage, 'imageFile');

        // Extract the upload directory from the VichUploader mapping
        $uploadDir = $mapping->getUploadDestination();

        return $uploadDir;
    }
}