<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreFarmMetadataType
 *
 * @ORM\Table(name="core_farm_metadata_type", uniqueConstraints={@ORM\UniqueConstraint(name="code_2", columns={"code"})}, indexes={@ORM\Index(name="code", columns={"code"})})
 * @ORM\Entity
 */
class CoreFarmMetadataType
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
     * @var int
     *
     * @ORM\Column(name="code", type="integer", nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isActive = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="farmer_has_multiple", type="boolean", nullable=false)
     */
    private $farmerHasMultiple = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=true)
     */
    private $parentId;

    /**
     * @var string
     *
     * @ORM\Column(name="model_class_name", type="string", length=255, nullable=false)
     */
    private $modelClassName;

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


}
