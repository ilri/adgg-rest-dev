<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreTableAttribute
 *
 * @ORM\Table(name="core_table_attribute", indexes={@ORM\Index(name="farm_metadata_type", columns={"farm_metadata_type"}), @ORM\Index(name="group_id", columns={"group_id"}), @ORM\Index(name="list_type_id", columns={"list_type_id"}), @ORM\Index(name="table_id", columns={"table_id"})})
 * @ORM\Entity
 */
class CoreTableAttribute
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
     * @ORM\Column(name="attribute_key", type="string", length=128, nullable=false)
     */
    private $attributeKey;

    /**
     * @var string
     *
     * @ORM\Column(name="attribute_label", type="string", length=255, nullable=false)
     */
    private $attributeLabel;

    /**
     * @var int
     *
     * @ORM\Column(name="table_id", type="integer", nullable=false)
     */
    private $tableId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="group_id", type="integer", nullable=true)
     */
    private $groupId;

    /**
     * @var int
     *
     * @ORM\Column(name="input_type", type="integer", nullable=false)
     */
    private $inputType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="default_value", type="string", length=255, nullable=true)
     */
    private $defaultValue;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="event_type", type="boolean", nullable=true)
     */
    private $eventType;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="is_alias", type="boolean", nullable=false)
     */
    private $isAlias = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="alias_to", type="string", length=255, nullable=true)
     */
    private $aliasTo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="farm_metadata_type", type="integer", nullable=true)
     */
    private $farmMetadataType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="odk_attribute_name", type="string", length=128, nullable=true)
     */
    private $odkAttributeName;

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
     * @var \CoreMasterListType
     *
     * @ORM\ManyToOne(targetEntity="CoreMasterListType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="list_type_id", referencedColumnName="id")
     * })
     */
    private $listType;


}
