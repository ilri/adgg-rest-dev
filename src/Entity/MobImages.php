<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\CreatedTrait;
use App\Repository\MobImagesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\EventListener\MobImageListener;

/**
 * @ORM\Table (name="mob_images")
 * @ORM\Entity(repositoryClass=MobImagesRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
#[ApiResource]
class MobImages
{
    use CreatedTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="mob_data_id", type="integer")
     */
    private $mobDataId;

    /**
     * @ORM\Column(name="core_table_id", type="integer")
     */
    private $coreTableId;

    /**
     * @ORM\Column(name="core_table_type", type="integer")
     */
    private $coreTableType;

    /**
     * @ORM\Column(name="image_file_path",type="string", length=255)
     */
    private $imageFilePath;

    /**
     * @ORM\Column(name="image_server_location",type="string", length=255)
     */
    private $imageServerLocation;



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCoreTableId()
    {
        return $this->coreTableId;
    }

    /**
     * @param mixed $coreTableId
     */
    public function setCoreTableId($coreTableId): void
    {
        $this->coreTableId = $coreTableId;
    }

    /**
     * @return mixed
     */
    public function getCoreTableType()
    {
        return $this->coreTableType;
    }

    /**
     * @param mixed $coreTableType
     */
    public function setCoreTableType($coreTableType): void
    {
        $this->coreTableType = $coreTableType;
    }

    /**
     * @return mixed
     */
    public function getImageFilePath()
    {
        return $this->imageFilePath;
    }

    /**
     * @param mixed $imageFilePath
     */
    public function setImageFilePath($imageFilePath): void
    {
        $this->imageFilePath = $imageFilePath;
    }

    /**
     * @return mixed
     */
    public function getImageServerLocation()
    {
        return $this->imageServerLocation;
    }

    /**
     * @param mixed $imageServerLocation
     */
    public function setImageServerLocation($imageServerLocation): void
    {
        $this->imageServerLocation = $imageServerLocation;
    }

    public function uploadImageFile(): void
    {
        if (null === $this->imageFile) {
            return;
        }

        $originalFilename = pathinfo($this->imageFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $originalFilename.'-'.uniqid().'.'.$this->imageFile->guessExtension();

        $this->imageFilePath = $newFilename;
        $this->imageServerLocation = 'public/images/mob_images/';

        $this->imageFile->move(
            $this->getImageUploadDirectory(),
            $this->imageFilePath
        );

        $this->imageFile = null;
    }

    private function getImageUploadDirectory(): string
    {
        return __DIR__.'/../../public/uploads/images';
    }

    /**
     * @var File|null
     * imageFile property is of type File or null. This property is used to temporarily store an instance of the
     * uploaded file during the file upload process. The File class is part of Symfony's HttpFoundation
     */
    private $imageFile;

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;

        if ($this->imageFile instanceof UploadedFile) {
            $this->setCreatedAtValue(new \DateTime('now'));
        }
    }


}
