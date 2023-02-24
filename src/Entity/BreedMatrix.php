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
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $breed_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $species_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $country_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $is_active;

    /**
     * @ORM\Column(type="integer")
     */
    private $created_by;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $updated_by;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBreedId(): ?int
    {
        return $this->breed_id;
    }

    public function setBreedId(int $breed_id): self
    {
        $this->breed_id = $breed_id;

        return $this;
    }

    public function getSpeciesId(): ?int
    {
        return $this->species_id;
    }

    public function setSpeciesId(int $species_id): self
    {
        $this->species_id = $species_id;

        return $this;
    }

    public function getCountryId(): ?int
    {
        return $this->country_id;
    }

    public function setCountryId(int $country_id): self
    {
        $this->country_id = $country_id;

        return $this;
    }

    public function getIsActive(): ?int
    {
        return $this->is_active;
    }

    public function setIsActive(int $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->created_by;
    }

    public function setCreatedBy(int $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }

    public function getUpdatedBy(): ?int
    {
        return $this->updated_by;
    }

    public function setUpdatedBy(?int $updated_by): self
    {
        $this->updated_by = $updated_by;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
