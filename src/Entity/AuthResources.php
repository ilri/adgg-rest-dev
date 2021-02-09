<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * AuthResources
 *
 * @ApiResource()
 * @ORM\Table(name="auth_resources")
 * @ORM\Entity
 */
class AuthResources
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=30, nullable=false)
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
     * @var bool
     *
     * @ORM\Column(name="viewable", type="boolean", nullable=false, options={"default"="1"})
     */
    private $viewable = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="creatable", type="boolean", nullable=false, options={"default"="1"})
     */
    private $creatable = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="editable", type="boolean", nullable=false, options={"default"="1"})
     */
    private $editable = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="deletable", type="boolean", nullable=false, options={"default"="1"})
     */
    private $deletable = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="executable", type="boolean", nullable=false)
     */
    private $executable = '0';

    public function getId(): ?string
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

    public function getViewable(): ?bool
    {
        return $this->viewable;
    }

    public function setViewable(bool $viewable): self
    {
        $this->viewable = $viewable;

        return $this;
    }

    public function getCreatable(): ?bool
    {
        return $this->creatable;
    }

    public function setCreatable(bool $creatable): self
    {
        $this->creatable = $creatable;

        return $this;
    }

    public function getEditable(): ?bool
    {
        return $this->editable;
    }

    public function setEditable(bool $editable): self
    {
        $this->editable = $editable;

        return $this;
    }

    public function getDeletable(): ?bool
    {
        return $this->deletable;
    }

    public function setDeletable(bool $deletable): self
    {
        $this->deletable = $deletable;

        return $this;
    }

    public function getExecutable(): ?bool
    {
        return $this->executable;
    }

    public function setExecutable(bool $executable): self
    {
        $this->executable = $executable;

        return $this;
    }


}
