<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * AuthUserLevels
 *
 * @ApiResource()
 * @ORM\Table(name="auth_user_levels")
 * @ORM\Entity
 */
class AuthUserLevels
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
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="forbidden_items", type="string", length=500, nullable=true)
     */
    private $forbiddenItems;

    /**
     * @var int|null
     *
     * @ORM\Column(name="parent_id", type="smallint", nullable=true)
     */
    private $parentId;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isActive = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getForbiddenItems(): ?string
    {
        return $this->forbiddenItems;
    }

    public function setForbiddenItems(?string $forbiddenItems): self
    {
        $this->forbiddenItems = $forbiddenItems;

        return $this;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function setParentId(?int $parentId): self
    {
        $this->parentId = $parentId;

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


}
