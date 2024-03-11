<?php

namespace App\Entity;

use App\Entity\Traits\{AdministrativeDivisionsTrait,
    CountryTrait,
    CreatedTrait,
    DataSourceTrait,
    IdentifiableTrait,
    ODKIdentifiableTrait,
    OrganisationTrait,
    UpdatedTrait};
use App\Repository\VActiveCoreAnimalRepository;
use ApiPlatform\Metadata\ApiResource;
use Carbon\Carbon;
use Doctrine\Common\Collections\{
    ArrayCollection,
    Collection
};
use Doctrine\ORM\Mapping as ORM;

/**
 * Animal View
 *
 * @ORM\Table(name="v_active_core_animal", indexes={@ORM\Index(name="animal_type", columns={"animal_type"}), @ORM\Index(name="country_id", columns={"country_id", "region_id", "district_id", "ward_id", "village_id"}), @ORM\Index(name="dam_id", columns={"dam_id"}), @ORM\Index(name="farm_id", columns={"farm_id"}), @ORM\Index(name="org_id", columns={"org_id", "client_id"}), @ORM\Index(name="reg_date", columns={"reg_date"}), @ORM\Index(name="sire_id", columns={"sire_id"}), @ORM\Index(name="tag_id", columns={"tag_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\VActiveCoreAnimalRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class VActiveCoreAnimal
{
    use AdministrativeDivisionsTrait;
    use CountryTrait;
    use CreatedTrait;
    use IdentifiableTrait;
    use ODKIdentifiableTrait;
    use OrganisationTrait;
    use UpdatedTrait;
    use DataSourceTrait;

    /**
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
     * @ORM\Column(name="mob_farm_id", type="string", length=50, nullable=true, options={"comment"="This is specific for AADGG mobile application farm_id"})
     */
    private $mobFarmId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mob_herd_id", type="string", length=50, nullable=true, options={"comment"="This is specific for AADGG mobile application herd_id"})
     */
    private $mobHerdId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mob_sire_id", type="string", length=50, nullable=true, options={"comment"="This is specific for AADGG mobile application sire_id"})
     */
    private $mobSireId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mob_dam_id", type="string", length=50, nullable=true, options={"comment"="This is specific for AADGG mobile application dam_id"})
     */
    private $mobDamId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sire_name", type="string", length=50, nullable=true, options={"comment"="This is specific for AADGG mobile application sire name"})
     */
    private $sireName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dam_name", type="string", length=50, nullable=true, options={"comment"="This is specific for AADGG mobile application dam name"})
     */
    private $damName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tag_id", type="string", length=128, nullable=true)
     */
    private $tagId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="original_tag_id", type="string", length=128, nullable=true)
     */
    private $originalTagId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="herd_id", type="integer", nullable=true)
     */
    private $herdId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="animal_type", type="integer", nullable=true)
     */
    private $animalType;

    /**
     * @var int|null
     *
     * @ORM\Column(name="species", type="integer", nullable=true)
     */
    private $species;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sex", type="integer", nullable=true)
     */
    private $sex;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="birthdate", type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sire_type", type="integer", nullable=true)
     */
    private $sireType;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sire_id", type="integer", nullable=true)
     */
    private $sireId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sire_tag_id", type="string", length=128, nullable=true)
     */
    private $sireTagId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="dam_id", type="integer", nullable=true)
     */
    private $damId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dam_tag_id", type="string", length=128, nullable=true)
     */
    private $damTagId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="main_breed", type="integer", nullable=true)
     */
    private $mainBreed;

    /**
     * @var int|null
     *
     * @ORM\Column(name="breed_composition", type="integer", nullable=true)
     */
    private $breedComposition;

    /**
     * @var string|null
     *
     * @ORM\Column(name="animal_photo", type="string", length=255, nullable=true)
     */
    private $animalPhoto;

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
     */
    private $longitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="map_address", type="string", length=255, nullable=true)
     */
    private $mapAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latlng", type="string", length=0, nullable=true)
     */
    private $latlng;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="reg_date", type="date", nullable=true)
     */
    private $regDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hair_sample_id", type="string", length=128, nullable=true)
     */
    private $hairSampleId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="migration_id", type="string", length=255, nullable=true, options={"comment"="This is the migrationSouce plus primary key from migration source table of the record e.g KLBA_001"})
     */
    private $migrationId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="odk_animal_code", type="string", length=30, nullable=true, options={"comment"= *     "animal code from Harrison db for odk form versions 1.5 and below "})
     */
    private $odkAnimalCode;

    /**
     * @var Farm
     *
     * @ORM\ManyToOne(targetEntity="Farm")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="farm_id", referencedColumnName="id")
     * })
     */
    private $farm;

    /**
     * @var int|null
     *
     * @ORM\Column(name="farm_id", type="integer", nullable=true)
     *
     */
    private $farmId;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AnimalEvent", mappedBy="animal")
     * @ORM\OrderBy({"eventDate" = "DESC"})
     */
    private $animalEvents;

    /**
     * @var array|null
     *
     * @ORM\Column(name="additional_attributes", type="json", nullable=true)
     */
    protected $additionalAttributes;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     *
     */
    private $isActive = true;

    /**
     * @var array|null
     *
     * @ORM\Column(name="mob_additional_attributes", type="json", nullable=true)
     */
    protected $mobAdditionalAttributes;


    public function getMobAdditionalAttributes(): ?array
    {
        return $this->mobAdditionalAttributes;
    }

    public function setMobAdditionalAttributes(?array $mobAdditionalAttributes): self
    {
        $this->mobAdditionalAttributes = $mobAdditionalAttributes;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function getAdditionalAttributes(): ?array
    {
        return $this->additionalAttributes;
    }

    public function setAdditionalAttributes(?array $additionalAttributes): self
    {
        $this->additionalAttributes = $additionalAttributes;

        return $this;
    }

    public function __construct()
    {
        $this->animalEvents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMobDataId(): ?string
    {
        return $this->mobDataId;
    }


    public function getMobFarmId(): ?string
    {
        return $this->mobFarmId;
    }


    public function getMobHerdId(): ?string
    {
        return $this->mobHerdId;
    }


    public function getMobSireId(): ?string
    {
        return $this->mobSireId;
    }


    public function getMobDamId(): ?string
    {
        return $this->mobDamId;
    }


    public function getName(): ?string
    {
        return $this->name;
    }


    public function getSireName(): ?string
    {
        return $this->sireName;
    }


    public function getDamName(): ?string
    {
        return $this->damName;
    }

    public function getTagId(): ?string
    {
        return $this->tagId;
    }

    public function getOriginalTagId(): ?string
    {
        return $this->originalTagId;
    }


    public function getHerdId(): ?int
    {
        return $this->herdId;
    }

    public function getAnimalType(): ?int
    {
        return $this->animalType;
    }


    public function getSpecies(): ?int
    {
        return $this->species;
    }


    public function getSex(): ?int
    {
        return $this->sex;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }


    public function getSireType(): ?int
    {
        return $this->sireType;
    }


    public function getSireId(): ?int
    {
        return $this->sireId;
    }


    public function getSireTagId(): ?string
    {
        return $this->sireTagId;
    }

    public function getDamId(): ?int
    {
        return $this->damId;
    }


    public function getDamTagId(): ?string
    {
        return $this->damTagId;
    }


    public function getMainBreed(): ?int
    {
        return $this->mainBreed;
    }


    public function getBreedComposition(): ?int
    {
        return $this->breedComposition;
    }


    public function getAnimalPhoto(): ?string
    {
        return $this->animalPhoto;
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


    public function getRegDate(): ?\DateTimeInterface
    {
        return $this->regDate;
    }

    public function getHairSampleId(): ?string
    {
        return $this->hairSampleId;
    }

    public function getMigrationId(): ?string
    {
        return $this->migrationId;
    }


    public function getOdkAnimalCode(): ?string
    {
        return $this->odkAnimalCode;
    }


    public function getFarm(): ?Farm
    {
        return $this->farm;
    }

    public function getFarmId(): ?int
    {
        return $this->farmId;
    }



}
