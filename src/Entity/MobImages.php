<?php

namespace App\Entity;

use App\Entity\Traits\UpdatedTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Table(name="mob_images")
 * @ORM\Entity(repositoryClass="App\Repository\MobImagesRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 * @ApiResource(
 *       iri="http://schema.org/MediaObject",
 *       normalizationContext={
 *           "groups"={"media_object_read"}
 *       },
 *       collectionOperations={
 *           "post"={
 *               "controller"=ImageUploadController::class,
 *               "deserialize"=false,
 *
 *               "validation_groups"={"Default", "media_object_create"},
 *               "openapi_context"={
 *                   "requestBody"={
 *                       "content"={
 *                           "multipart/form-data"={
 *                               "schema"={
 *                                   "type"="object",
 *                                   "properties"={
 *                                       "file"={
 *                                           "type"="string",
 *                                           "format"="binary"
 *                                       }
 *                                   }
 *                               }
 *                           }
 *                       }
 *                   }
 *               }
 *           },
 *           "get"
 *       },
 *       itemOperations={
 *           "get"
 *       },
 *      attributes={
 *            "path"="/api/images"
 *        }
 *   )
 */
class MobImages
{
    use UpdatedTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="mob_data_id", type="integer")
     */
    private $mobImageDataId;

    /**
     * @ORM\Column(name="core_table_id", type="integer")
     */
    private $coreTableId;

    /**
     * @ORM\Column(name="core_table_type", type="integer")
     */
    private $coreTableType;

    /**
     * @ORM\Column(name="image_file_name", type="string", length=255, nullable=true)
     */
    private $imageName;


    /**
     * @ORM\Column(name="image_server_location", type="string", length=255)
     */
    private $imageServerLocation;

    /**
     * @Vich\UploadableField(mapping="mob_images", fileNameProperty="imageName")
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;


    /**
     * @var int|null
     *
     * @ORM\Column(name="field_id", type="integer", nullable=true)
     */
    private $fieldId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="file_data_id", type="integer", nullable=true)
     */
    private $mobFileDataId;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;
        return $this;
    }


    public function setImageFilePath($imageName): void
    {
        $this->imageName = $imageName;
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

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called, and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMobImageDataId()
    {
        return $this->mobImageDataId;
    }

    /**
     * @param mixed $mobImageDataId
     */
    public function setMobImageDataId($mobImageDataId): void
    {
        $this->mobImageDataId = $mobImageDataId;
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

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }


    /**
     * @param int|null $createdBy
     */
    public function setCreatedBy(?int $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
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

    public function getFieldId(): ?int
    {
        return $this->fieldId;
    }

    public function setFieldId(?int $fieldId): void
    {
        $this->fieldId = $fieldId;
    }

    public function getMobFileDataId(): ?int
    {
        return $this->mobFileDataId;
    }

    public function setMobFileDataId(?int $mobFileDataId): void
    {
        $this->mobFileDataId = $mobFileDataId;
    }


}
