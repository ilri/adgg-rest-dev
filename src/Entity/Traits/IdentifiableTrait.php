<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait IdentifiableTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=255, nullable=true)
     */
    protected $uuid;

    /**
     * @var array|null
     *
     * @ORM\Column(name="additional_attributes", type="json", nullable=true)
     */
    protected $additionalAttributes;

    /**
     * @var int|null
     *
     * @ORM\Column(name="org_id", type="integer", nullable=true)
     */
    protected $orgId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="client_id", type="integer", nullable=true)
     */
    protected $clientId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @ORM\Version
     */
    protected $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    protected $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @ORM\Version
     */
    protected $updatedAt;
    
    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=true)})
     */
    protected $updatedBy;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="odk_form_uuid", type="string", length=128, nullable=true)
     */
    protected $odkFormUuid;

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getAdditionalAttributes(): ?array
    {
        return $this->additionalAttributes;
    }

    public function setAdditionalAttributes(?array $additionalAttributes): self
    {
        $this->additionalAttributes = $additionalAttributes;

        return $this;
    }

    public function getOrgId(): ?int
    {
        return $this->orgId;
    }

    public function setOrgId(?int $orgId): self
    {
        $this->orgId = $orgId;

        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function setClientId(?int $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
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

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
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

    public function getOdkFormUuid(): ?string
    {
        return $this->odkFormUuid;
    }

    public function setOdkFormUuid(?string $odkFormUuid): self
    {
        $this->odkFormUuid = $odkFormUuid;

        return $this;
    }
}