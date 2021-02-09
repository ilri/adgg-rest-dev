<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthUserLevels
 *
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


}
