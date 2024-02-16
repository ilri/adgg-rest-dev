<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MobImagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table (name="mob_images")
 * @ORM\Entity(repositoryClass=MobImagesRepository::class)
 */
#[ApiResource]
class MobImages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="source_id", type="integer")
     */
    private $sourceId;

    /**
     * @ORM\Column(name="image_name", type="string", length=255)
     */
    private $imageName;

    /**
     * @ORM\Column(name="description",type="string", length=255)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSourceId(): ?int
    {
        return $this->sourceId;
    }

    public function setSourceId(int $sourceId): self
    {
        $this->sourceId = $sourceId;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
