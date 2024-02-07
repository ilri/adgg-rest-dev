<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VActiveCoreMasterListsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="v_active_core_master_lists", indexes={@ORM\Index(name="list_type_id", columns={"list_type_id"})})
 * @ORM\Entity(repositoryClass=VActiveCoreMasterListsRepository::class)
 */
#[ApiResource]
class VActiveCoreMasterLists
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $value;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $order_by;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $species_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $list_type_id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_active;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $created_by;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setValue(?int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }


    public function getOrderBy(): ?int
    {
        return $this->order_by;
    }

    public function getSpeciesId(): ?int
    {
        return $this->species_id;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }


    public function getListTypeId(): ?int
    {
        return $this->list_type_id;
    }


    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }


    public function getCreatedBy(): ?int
    {
        return $this->created_by;
    }

}
