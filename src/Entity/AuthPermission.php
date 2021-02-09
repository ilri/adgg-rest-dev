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
     * @var \AuthRoles
     *
     * @ORM\ManyToOne(targetEntity="AuthRoles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    private $role;

    /**
     * @var \AuthResources
     *
     * @ORM\ManyToOne(targetEntity="AuthResources")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     * })
     */
    private $resource;


}
