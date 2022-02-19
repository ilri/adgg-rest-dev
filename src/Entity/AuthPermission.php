<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthPermission
 *
 * @ORM\Table(name="auth_permission", indexes={@ORM\Index(name="resource_id", columns={"resource_id"}), @ORM\Index(name="role_id", columns={"role_id"})})
 * @ORM\Entity
 */
class AuthPermission
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
     * @var bool
     *
     * @ORM\Column(name="can_view", type="boolean", nullable=false, options={"default"="1"})
     */
    private $canView = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="can_create", type="boolean", nullable=false)
     */
    private $canCreate = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="can_update", type="boolean", nullable=false)
     */
    private $canUpdate = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="can_delete", type="boolean", nullable=false)
     */
    private $canDelete = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="can_execute", type="boolean", nullable=false, options={"default"="1"})
     */
    private $canExecute = true;

    /**
     * @var UserRole
     *
     * @ORM\ManyToOne(targetEntity="UserRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    private $role;

    /**
     * @var AuthResources
     *
     * @ORM\ManyToOne(targetEntity="AuthResources")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     * })
     */
    private $resource;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCanView(): ?bool
    {
        return $this->canView;
    }

    public function setCanView(bool $canView): self
    {
        $this->canView = $canView;

        return $this;
    }

    public function getCanCreate(): ?bool
    {
        return $this->canCreate;
    }

    public function setCanCreate(bool $canCreate): self
    {
        $this->canCreate = $canCreate;

        return $this;
    }

    public function getCanUpdate(): ?bool
    {
        return $this->canUpdate;
    }

    public function setCanUpdate(bool $canUpdate): self
    {
        $this->canUpdate = $canUpdate;

        return $this;
    }

    public function getCanDelete(): ?bool
    {
        return $this->canDelete;
    }

    public function setCanDelete(bool $canDelete): self
    {
        $this->canDelete = $canDelete;

        return $this;
    }

    public function getCanExecute(): ?bool
    {
        return $this->canExecute;
    }

    public function setCanExecute(bool $canExecute): self
    {
        $this->canExecute = $canExecute;

        return $this;
    }

    public function getRole(): ?UserRole
    {
        return $this->role;
    }

    public function setRole(?UserRole $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getResource(): ?AuthResources
    {
        return $this->resource;
    }

    public function setResource(?AuthResources $resource): self
    {
        $this->resource = $resource;

        return $this;
    }


}
