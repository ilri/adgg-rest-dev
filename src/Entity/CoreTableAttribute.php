<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CoreTablleAttributeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="v_active_core_table_attributes")
 * @ORM\Entity(repositoryClass=CoreTablleAttributeRepository::class)
 */
#[ApiResource]
class CoreTableAttribute
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="attribute_key", type="string", length=255)
     */
    private $attributeKey;

    /**
     * @ORM\Column(name="attribute_label", type="string", length=255, nullable=true)
     */
    private $attributeLabel;

    /**
     * @ORM\Column(name="table_id" ,type="integer", nullable=true)
     */
    private $tableId;

    /**
     * @ORM\Column(name="farm_metadata_type" ,type="integer", nullable=true)
     */
    private $farmMetadataType;

    /**
     * @ORM\Column(name="group_id", type="integer", nullable=true)
     */
    private $groupId;

    /**
     * @ORM\Column(name="input_type", type="integer", nullable=true)
     */
    private $inputType;

    /**
     * @ORM\Column(name="default_value", type="string", length=255, nullable=true)
     */
    private $defaultValue;

    /**
     * @ORM\Column(name="list_type_id", type="integer", nullable=true)
     */
    private $listTypeId;

    /**
     * @ORM\Column(name="event_type", type="integer", nullable=true)
     */
    private $eventType;

    /**
     * @ORM\Column(name="event_name", type="string", length=255, nullable=true)
     */
    private $eventName;

    /**
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @ORM\Column(name="created_at", type="datetime_immutable", nullable=true)
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

    public function getAttributeKey(): ?string
    {
        return $this->attributeKey;
    }

    public function setAttributeKey(string $attributeKey): self
    {
        $this->attributeKey = $attributeKey;

        return $this;
    }

    public function getAttributeLabel(): ?string
    {
        return $this->attributeLabel;
    }

    public function setAttributeLabel(?string $attributeLabel): self
    {
        $this->attributeLabel = $attributeLabel;

        return $this;
    }

    public function getTableId(): ?int
    {
        return $this->tableId;
    }

    public function setTableId(?int $tableId): self
    {
        $this->tableId = $tableId;

        return $this;
    }

    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    public function setGroupId(?int $groupId): self
    {
        $this->groupId = $groupId;

        return $this;
    }

    public function getInputType(): ?int
    {
        return $this->inputType;
    }

    public function setInputType(?int $inputType): self
    {
        $this->inputType = $inputType;

        return $this;
    }

    public function getDefaultValue(): ?string
    {
        return $this->defaultValue;
    }

    public function setDefaultValue(?string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    public function getListTypeId(): ?int
    {
        return $this->listTypeId;
    }

    public function setListTypeId(?int $listTypeId): self
    {
        $this->listTypeId = $listTypeId;

        return $this;
    }

    public function getEventType(): ?int
    {
        return $this->eventType;
    }

    public function setEventType(?int $eventType): self
    {
        $this->eventType = $eventType;

        return $this;
    }

    public function getEventName(): ?string
    {
        return $this->eventName;
    }

    public function setEventName(?string $eventName): self
    {
        $this->eventName = $eventName;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getFarmMetadataType()
    {
        return $this->farmMetadataType;
    }


    public function setFarmMetadataType($farmMetadataType): void
    {
        $this->farmMetadataType = $farmMetadataType;
    }


}
