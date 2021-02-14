<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceGraduationList
 *
 * @ORM\Table(name="interface_graduation_list")
 * @ORM\Entity
 */
class InterfaceGraduationList
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
     * @ORM\Column(name="animal_id", type="integer", nullable=true)
     */
    private $animalId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="graduate_from", type="integer", nullable=true)
     */
    private $graduateFrom;

    /**
     * @var int|null
     *
     * @ORM\Column(name="graduate_to", type="integer", nullable=true)
     */
    private $graduateTo;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="status_id", type="boolean", nullable=true)
     */
    private $statusId = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="graduation_process_id", type="integer", nullable=true)
     */
    private $graduationProcessId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="action", type="string", length=100, nullable=true)
     */
    private $action;

    /**
     * @var string|null
     *
     * @ORM\Column(name="uuid", type="string", length=250, nullable=true)
     */
    private $uuid;

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

    public function getAnimalId(): ?int
    {
        return $this->animalId;
    }

    public function setAnimalId(?int $animalId): self
    {
        $this->animalId = $animalId;

        return $this;
    }

    public function getGraduateFrom(): ?int
    {
        return $this->graduateFrom;
    }

    public function setGraduateFrom(?int $graduateFrom): self
    {
        $this->graduateFrom = $graduateFrom;

        return $this;
    }

    public function getGraduateTo(): ?int
    {
        return $this->graduateTo;
    }

    public function setGraduateTo(?int $graduateTo): self
    {
        $this->graduateTo = $graduateTo;

        return $this;
    }

    public function getStatusId(): ?bool
    {
        return $this->statusId;
    }

    public function setStatusId(?bool $statusId): self
    {
        $this->statusId = $statusId;

        return $this;
    }

    public function getGraduationProcessId(): ?int
    {
        return $this->graduationProcessId;
    }

    public function setGraduationProcessId(?int $graduationProcessId): self
    {
        $this->graduationProcessId = $graduationProcessId;

        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(?string $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(?string $uuid): self
    {
        $this->uuid = $uuid;

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
