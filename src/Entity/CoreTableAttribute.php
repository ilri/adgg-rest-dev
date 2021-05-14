<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * CoreTableAttribute
 *
 * @ORM\Table(name="core_table_attribute", indexes={@ORM\Index(name="farm_metadata_type", columns={"farm_metadata_type"}), @ORM\Index(name="group_id", columns={"group_id"}), @ORM\Index(name="list_type_id", columns={"list_type_id"}), @ORM\Index(name="table_id", columns={"table_id"})})
 * @ORM\Entity
 */
class CoreTableAttribute
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
     * @var string
     *
     * @ORM\Column(name="attribute_key", type="string", length=128, nullable=false)
     */
    private $attributeKey;

    /**
     * @var string
     *
     * @ORM\Column(name="attribute_label", type="string", length=255, nullable=false)
     */
    private $attributeLabel;

    /**
     * @var int
     *
     * @ORM\Column(name="table_id", type="integer", nullable=false)
     */
    private $tableId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="group_id", type="integer", nullable=true)
     */
    private $groupId;

    /**
     * @var int
     *
     * @ORM\Column(name="input_type", type="integer", nullable=false)
     */
    private $inputType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="default_value", type="string", length=255, nullable=true)
     */
    private $defaultValue;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="event_type", type="boolean", nullable=true)
     */
    private $eventType;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="is_alias", type="boolean", nullable=false)
     */
    private $isAlias = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="alias_to", type="string", length=255, nullable=true)
     */
    private $aliasTo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="farm_metadata_type", type="integer", nullable=true)
     */
    private $farmMetadataType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="odk_attribute_name", type="string", length=128, nullable=true)
     */
    private $odkAttributeName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;

    /**
     * @var MasterListType
     *
     * @ORM\ManyToOne(targetEntity="MasterListType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="list_type_id", referencedColumnName="id")
     * })
     */
    private $listType;

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

    public function setAttributeLabel(string $attributeLabel): self
    {
        $this->attributeLabel = $attributeLabel;

        return $this;
    }

    public function getTableId(): ?int
    {
        return $this->tableId;
    }

    public function setTableId(int $tableId): self
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

    public function setInputType(int $inputType): self
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

    public function getEventType(): ?bool
    {
        return $this->eventType;
    }

    public function setEventType(?bool $eventType): self
    {
        $this->eventType = $eventType;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getIsAlias(): ?bool
    {
        return $this->isAlias;
    }

    public function setIsAlias(bool $isAlias): self
    {
        $this->isAlias = $isAlias;

        return $this;
    }

    public function getAliasTo(): ?string
    {
        return $this->aliasTo;
    }

    public function setAliasTo(?string $aliasTo): self
    {
        $this->aliasTo = $aliasTo;

        return $this;
    }

    public function getFarmMetadataType(): ?int
    {
        return $this->farmMetadataType;
    }

    public function setFarmMetadataType(?int $farmMetadataType): self
    {
        $this->farmMetadataType = $farmMetadataType;

        return $this;
    }

    public function getOdkAttributeName(): ?string
    {
        return $this->odkAttributeName;
    }

    public function setOdkAttributeName(?string $odkAttributeName): self
    {
        $this->odkAttributeName = $odkAttributeName;

        return $this;
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

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?int $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getListType(): ?MasterListType
    {
        return $this->listType;
    }

    public function setListType(?MasterListType $listType): self
    {
        $this->listType = $listType;

        return $this;
    }
}
