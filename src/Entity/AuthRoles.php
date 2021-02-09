<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthRoles
 *
 * @ORM\Table(name="auth_roles", indexes={@ORM\Index(name="level_id", columns={"level_id"})})
 * @ORM\Entity
 */
class AuthRoles
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
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="readonly", type="boolean", nullable=false)
     */
    private $readonly = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="is_field_agent", type="boolean", nullable=false)
     */
    private $isFieldAgent = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isActive = true;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;

    /**
     * @var \AuthUserLevels
     *
     * @ORM\ManyToOne(targetEntity="AuthUserLevels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="level_id", referencedColumnName="id")
     * })
     */
    private $level;


}
