<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HelpContent
 *
 * @ORM\Table(name="help_content", indexes={@ORM\Index(name="FK_help_content_help_modules", columns={"module_id"})})
 * @ORM\Entity
 */
class HelpContent
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="module_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $moduleId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="user_level_id", type="integer", nullable=true)
     */
    private $userLevelId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=0, nullable=false)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="permissions", type="string", length=255, nullable=false)
     */
    private $permissions;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tags", type="string", length=255, nullable=true)
     */
    private $tags;

    /**
     * @var string|null
     *
     * @ORM\Column(name="secondary_permissions", type="string", length=255, nullable=true)
     */
    private $secondaryPermissions;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

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

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true, options={"default"="1"})
     */
    private $isActive = true;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_for_android", type="boolean", nullable=true)
     */
    private $isForAndroid = '0';


}
