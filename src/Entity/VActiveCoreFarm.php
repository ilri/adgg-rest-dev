<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\AdditionalAttributesTrait;
use App\Entity\Traits\AdministrativeDivisionsTrait;
use App\Entity\Traits\CountryTrait;
use App\Entity\Traits\CreatedTrait;
use App\Entity\Traits\IdentifiableTrait;
use App\Entity\Traits\ODKIdentifiableTrait;
use App\Entity\Traits\OrganisationTrait;
use App\Entity\Traits\UpdatedTrait;
use App\Repository\VActiveCoreFarmRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="v_active_core_farm")
 * @ORM\Entity(repositoryClass=VActiveCoreFarmRepository::class)
 */
#[ApiResource]
class VActiveCoreFarm
{
    use AdministrativeDivisionsTrait;
    use AdditionalAttributesTrait;
    use CountryTrait;
    use CreatedTrait;
    use IdentifiableTrait;
    use ODKIdentifiableTrait;
    use OrganisationTrait;
    use UpdatedTrait;
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
     * @ORM\Column(name="mob_data_id", type="string", length=45, nullable=true, options={"comment"="This is specific for AADGG mobile application"})
     */
    private $mobDataId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code", type="string", length=128, nullable=true)
     *
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="reg_date", type="date", nullable=true)
     *
     */
    private $regDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="farmer_name", type="string", length=128, nullable=true)
     *
     */
    private $farmerName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     *
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     *
     */
    private $email;

    /**
     * @var int|null
     *
     * @ORM\Column(name="field_agent_id", type="integer", nullable=true)
     *
     */
    private $fieldAgentId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="project", type="string", length=128, nullable=true)
     *
     */
    private $project;

    /**
     * @var string|null
     *
     * @ORM\Column(name="farm_type", type="string", length=30, nullable=true)
     *
     */
    private $farmType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="gender_code", type="string", length=10, nullable=true)
     *
     */
    private $genderCode;

    /**
     * @var bool
     *
     * @ORM\Column(name="farmer_is_hh_head", type="boolean", nullable=false, options={"default"="1"})
     *
     */
    private $farmerIsHhHead = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     *
     */
    private $isActive = true;

    /**
     * @var int|null
     *
     * @ORM\Column(name="is_cooperative", type="integer", nullable=true)
     *
     */
    private $isCooperative = true;

    /**
     * @var int|null
     *
     * @ORM\Column(name="is_group", type="integer", nullable=true)
     *
     */
    private $isGroup = true;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latitude", type="decimal", precision=13, scale=8, nullable=true)
     */
    private $latitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="longitude", type="decimal", precision=13, scale=8, nullable=true)
     *
     */
    private $longitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="map_address", type="string", length=255, nullable=true)
     *
     */
    private $mapAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latlng", type="string", length=0, nullable=true)
     *
     */
    private $latlng;

    /**
     * @var string|null
     *
     * @ORM\Column(name="odk_code", type="string", length=255, nullable=true)
     *
     */
    private $odkCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="odk_farm_code", type="string", length=128, nullable=true, options={"comment"="Farm code from Harrison db for odk form versions 1.5 and below"})
     *
     */
    private $odkFarmCode;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_deleted", type="boolean", nullable=false)
     */
    private $isDeleted;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     *
     */
    private $deletedAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="deleted_by", type="integer", nullable=true)
     * })
     */
    private $deletedBy;

    /**
     * @var string|null
     *
     * @ORM\Column(name="migration_id", type="string", length=255, nullable=true, options={"comment"="This is the migrationSouce plus primary key from migration source table of the record e.g KLBA_001"})
     */
    private $migrationId;


    /**
     * @var string|null
     *
     * @ORM\Column(name="unique_id_odk", type="string", length=45, nullable=true)
     *
     */
    private $uniqueIdOdk;

    /**
     * @var int
     *
     * @ORM\Column(name="country_id", type="integer", nullable=false)
     */
    protected $countryId;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMobDataId(): ?string
    {
        return $this->mobDataId;
    }


    public function getIsCooperative(): ?int
    {
        return $this->isCooperative;
    }


    public function getIsGroup(): ?int
    {
        return $this->isGroup;
    }


    public function getCode(): ?string
    {
        return $this->code;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function getRegDate(): ?\DateTimeInterface
    {
        return $this->regDate;
    }


    public function getFarmerName(): ?string
    {
        return $this->farmerName;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }


    public function getFieldAgentId(): ?int
    {
        return $this->fieldAgentId;
    }


    public function getProject(): ?string
    {
        return $this->project;
    }


    public function getFarmType(): ?string
    {
        return $this->farmType;
    }


    public function getGenderCode(): ?string
    {
        return $this->genderCode;
    }

    public function getFarmerIsHhHead(): ?bool
    {
        return $this->farmerIsHhHead;
    }


    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }


    public function getLatitude(): ?string
    {
        return $this->latitude;
    }


    public function getLongitude(): ?string
    {
        return $this->longitude;
    }


    public function getMapAddress(): ?string
    {
        return $this->mapAddress;
    }


    public function getLatlng(): ?string
    {
        return $this->latlng;
    }


    public function getUuid(): ?string
    {
        return $this->uuid;
    }



    public function getOdkCode(): ?string
    {
        return $this->odkCode;
    }


    public function getOdkFarmCode(): ?string
    {
        return $this->odkFarmCode;
    }


    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }


    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }


    public function getDeletedBy(): ?int
    {
        return $this->deletedBy;
    }

    public function getMigrationId(): ?string
    {
        return $this->migrationId;
    }

    public function getUniqueIdOdk(): ?string
    {
        return $this->uniqueIdOdk;
    }

    public function getCountryId(): ?int
    {
        return $this->countryId;
    }
}
