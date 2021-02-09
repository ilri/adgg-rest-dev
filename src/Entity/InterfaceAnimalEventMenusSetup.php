<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceAnimalEventMenusSetup
 *
 * @ApiResource()
 * @ORM\Table(name="interface_animal_event_menus_setup")
 * @ORM\Entity
 */
class InterfaceAnimalEventMenusSetup
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="animal_type", type="integer", nullable=true)
     */
    private $animalType;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="calving", type="boolean", nullable=true)
     */
    private $calving = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="milking", type="boolean", nullable=true)
     */
    private $milking = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="health", type="boolean", nullable=true)
     */
    private $health = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="bio_data", type="boolean", nullable=true)
     */
    private $bioData = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="insemination", type="boolean", nullable=true)
     */
    private $insemination = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sync", type="boolean", nullable=true)
     */
    private $sync = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="exit", type="boolean", nullable=true)
     */
    private $exit = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="weight", type="boolean", nullable=true)
     */
    private $weight = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="pd", type="boolean", nullable=true)
     */
    private $pd = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=true)
     */
    private $updatedBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnimalType(): ?int
    {
        return $this->animalType;
    }

    public function setAnimalType(?int $animalType): self
    {
        $this->animalType = $animalType;

        return $this;
    }

    public function getCalving(): ?bool
    {
        return $this->calving;
    }

    public function setCalving(?bool $calving): self
    {
        $this->calving = $calving;

        return $this;
    }

    public function getMilking(): ?bool
    {
        return $this->milking;
    }

    public function setMilking(?bool $milking): self
    {
        $this->milking = $milking;

        return $this;
    }

    public function getHealth(): ?bool
    {
        return $this->health;
    }

    public function setHealth(?bool $health): self
    {
        $this->health = $health;

        return $this;
    }

    public function getBioData(): ?bool
    {
        return $this->bioData;
    }

    public function setBioData(?bool $bioData): self
    {
        $this->bioData = $bioData;

        return $this;
    }

    public function getInsemination(): ?bool
    {
        return $this->insemination;
    }

    public function setInsemination(?bool $insemination): self
    {
        $this->insemination = $insemination;

        return $this;
    }

    public function getSync(): ?bool
    {
        return $this->sync;
    }

    public function setSync(?bool $sync): self
    {
        $this->sync = $sync;

        return $this;
    }

    public function getExit(): ?bool
    {
        return $this->exit;
    }

    public function setExit(?bool $exit): self
    {
        $this->exit = $exit;

        return $this;
    }

    public function getWeight(): ?bool
    {
        return $this->weight;
    }

    public function setWeight(?bool $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getPd(): ?bool
    {
        return $this->pd;
    }

    public function setPd(?bool $pd): self
    {
        $this->pd = $pd;

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?int $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?int $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


}
