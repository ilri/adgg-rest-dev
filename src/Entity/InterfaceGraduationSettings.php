<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceGraduationSettings
 *
 * @ORM\Table(name="interface_graduation_settings")
 * @ORM\Entity
 */
class InterfaceGraduationSettings
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
     * @ORM\Column(name="org_id", type="integer", nullable=true)
     */
    private $orgId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="graduation_parameter", type="string", length=250, nullable=true)
     */
    private $graduationParameter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=250, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="graduate_from", type="string", length=250, nullable=true)
     */
    private $graduateFrom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="graduate_to", type="string", length=250, nullable=true)
     */
    private $graduateTo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="graduation_value", type="string", length=250, nullable=true)
     */
    private $graduationValue;

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
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=true)
     */
    private $updatedBy;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getGraduationParameter(): ?string
    {
        return $this->graduationParameter;
    }

    public function setGraduationParameter(?string $graduationParameter): self
    {
        $this->graduationParameter = $graduationParameter;

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

    public function getGraduateFrom(): ?string
    {
        return $this->graduateFrom;
    }

    public function setGraduateFrom(?string $graduateFrom): self
    {
        $this->graduateFrom = $graduateFrom;

        return $this;
    }

    public function getGraduateTo(): ?string
    {
        return $this->graduateTo;
    }

    public function setGraduateTo(?string $graduateTo): self
    {
        $this->graduateTo = $graduateTo;

        return $this;
    }

    public function getGraduationValue(): ?string
    {
        return $this->graduationValue;
    }

    public function setGraduationValue(?string $graduationValue): self
    {
        $this->graduationValue = $graduationValue;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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
}
