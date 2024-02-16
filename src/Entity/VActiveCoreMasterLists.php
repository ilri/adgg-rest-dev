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
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @var int|null
     *
     * @ORM\Column(name="order_by",type="integer", nullable=true)
     */
    private $orderBy;

    /**
     * @var int|null
     *
     * @ORM\Column(name="species_id", type="integer", nullable=true)
     */
    private $speciesId;

    /**
     * @ORM\Column(name="gender", type="string", length=255, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(name="list_type_id", type="integer", nullable=true)
     */
    private $listTypeId;

    /**
     * @ORM\Column(name="list_type_name", type="string", nullable=true)
     */
    private $listTypeName;

    /**
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }


    public function getLabel(): ?string
    {
        return $this->label;
    }


    public function getOrderBy(): ?int
    {
        return $this->orderBy;
    }

    public function getSpeciesId(): ?string
    {
        return $this->speciesId;
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
        return $this->listTypeId;
    }

    public function getListTypeName(): ?string
    {
        return $this->listTypeName;
    }


    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }


    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

}
