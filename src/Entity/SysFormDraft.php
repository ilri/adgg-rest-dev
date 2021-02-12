<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * SysFormDraft
 *
 * @ApiResource()
 * @ORM\Table(name="sys_form_draft")
 * @ORM\Entity
 */
class SysFormDraft
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
     * @var array
     *
     * @ORM\Column(name="model_attributes", type="json", nullable=false)
     */
    private $modelAttributes;

    /**
     * @var string
     *
     * @ORM\Column(name="model_class", type="string", length=1000, nullable=false)
     */
    private $modelClass;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModelAttributes(): ?array
    {
        return $this->modelAttributes;
    }

    public function setModelAttributes(array $modelAttributes): self
    {
        $this->modelAttributes = $modelAttributes;

        return $this;
    }

    public function getModelClass(): ?string
    {
        return $this->modelClass;
    }

    public function setModelClass(string $modelClass): self
    {
        $this->modelClass = $modelClass;

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


}
