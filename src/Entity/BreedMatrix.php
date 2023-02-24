<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BreedMatrixRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="core_animal_breed_matrix", indexes={@ORM\Index(name="country_id", columns={"country_id"})})
 * @ApiResource()
 * @ORM\Entity(repositoryClass=BreedMatrixRepository::class)
 */
class BreedMatrix
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private  $id;

    /**
     * @ORM\Column(name="breed_id", type="integer", length=128, nullable=true)
     */
    private $breedId;

    /**
     * @ORM\Column(name="species_id", type="integer", length=128, nullable=true)
     */
    private $speciesId;

    /**
     * @ORM\Column(name="country_id", type="integer", length=128, nullable=true)
     */
    private $countryId;

    /**
     * @ORM\Column(name="is_active", type="integer", length=128, nullable=true)
     */
    private $isActive;

    /**
     * @ORM\Column(name="created_by", type="integer", length=128, nullable=true)
     */
    private $createdBy;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createAt;

    /**
     * @ORM\Column(name="updated_by", type="integer", length=128, nullable=true)
     */
    private $updatedBy;

    /**
     * @ORM\Column(name="updated_at", type="integer", length=128, nullable=true)
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBreedId(): ?int
    {
        return $this->breedId;
    }

    public function setBreedId(int $breedId): self
    {
        $this->breedId = $breedId;

        return $this;
    }

    public function getSpeciesId(): ?int
    {
        return $this->speciesId;
    }

    public function setSpeciesId(int $speciesId): self
    {
        $this->speciesId = $speciesId;

        return $this;
    }

    public function getCountryId(): ?int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): self
    {
        $this->countryId = $countryId;

        return $this;
    }

    public function getIsActive(): ?int
    {
        return $this->isActive;
    }

    public function setIsActive(int $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(int $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

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
