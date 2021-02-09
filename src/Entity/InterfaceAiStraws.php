<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceAiStraws
 *
 * @ORM\Table(name="interface_ai_straws")
 * @ORM\Entity
 */
class InterfaceAiStraws
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
     * @var string|null
     *
     * @ORM\Column(name="straw_id", type="string", length=255, nullable=true)
     */
    private $strawId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="barcode", type="string", length=255, nullable=true)
     */
    private $barcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bull_tag_id", type="string", length=255, nullable=true)
     */
    private $bullTagId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bull_name", type="string", length=255, nullable=true)
     */
    private $bullName;

    /**
     * @var int|null
     *
     * @ORM\Column(name="breed", type="integer", nullable=true)
     */
    private $breed;

    /**
     * @var int|null
     *
     * @ORM\Column(name="breed_composition", type="integer", nullable=true)
     */
    private $breedComposition;

    /**
     * @var int|null
     *
     * @ORM\Column(name="semen_source", type="integer", nullable=true)
     */
    private $semenSource;

    /**
     * @var int|null
     *
     * @ORM\Column(name="origin_country", type="integer", nullable=true)
     */
    private $originCountry;

    /**
     * @var string|null
     *
     * @ORM\Column(name="farm_name", type="string", length=255, nullable=true)
     */
    private $farmName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="batch_number", type="string", length=255, nullable=true)
     */
    private $batchNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ejaculation_number", type="string", length=255, nullable=true)
     */
    private $ejaculationNumber;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="production_date", type="datetime", nullable=true)
     */
    private $productionDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="specification", type="string", length=10, nullable=true)
     */
    private $specification;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true, options={"default"="1"})
     */
    private $isActive = true;

    /**
     * @var string|null
     *
     * @ORM\Column(name="additional_info", type="string", length=255, nullable=true)
     */
    private $additionalInfo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="org_id", type="integer", nullable=true)
     */
    private $orgId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=true)
     */
    private $updatedBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


}
