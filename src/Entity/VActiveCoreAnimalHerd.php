<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\AdministrativeDivisionsTrait;
use App\Entity\Traits\CountryTrait;
use App\Entity\Traits\CreatedTrait;
use App\Entity\Traits\IdentifiableTrait;
use App\Entity\Traits\ODKIdentifiableTrait;
use App\Entity\Traits\OrganisationTrait;
use App\Entity\Traits\UpdatedTrait;
use App\Repository\VActiveCoreAnimalHerdRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="v_active_core_animal_herd")
 * @ORM\Entity(repositoryClass=VActiveCoreAnimalHerdRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
#[ApiResource]
class VActiveCoreAnimalHerd
{
    use AdministrativeDivisionsTrait;
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
     * @ORM\Column(name="mob_farm_id", type="string", length=45, nullable=true, options={"comment"="This is specific for AADGG mobile application farm_id"})
     */
    private $mobFarmId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="species_id", type="string", length=45, nullable=true, options={"comment"="This is specific for AADGG mobile application species_id"})
     */
    private $speciesId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

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
     * @ORM\Column(name="project", type="string", length=128, nullable=true))
     */
    private $project;

    /**
     * @var string|null
     *
     * @ORM\Column(name="migration_id", type="string", length=255, nullable=true, options={"comment"="This is the migrationSouce plus primary key from migration source table of the record e.g KLBA_001"})
     */
    private $migrationId;

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
     * @ORM\Column(name="farm_id",  nullable=true)
     */
    private $farmId;

    /**
     * @var array|null
     *
     * @ORM\Column(name="additional_attributes", type="json", nullable=true)
     */
    protected $additionalAttributes;

    /**
     * @var array|null
     *
     * @ORM\Column(name="mob_additional_attributes", type="json", nullable=true)
     */
    protected $mobAdditionalAttributes;


    public function getAdditionalAttributes(): ?array
    {
        return $this->additionalAttributes;
    }

    public function setAdditionalAttributes(?array $additionalAttributes): self
    {
        $this->additionalAttributes = $additionalAttributes;

        return $this;
    }

    public function getMobAdditionalAttributes(): ?array
    {
        return $this->mobAdditionalAttributes;
    }

    public function setMobAdditionalAttributes(?array $mobAdditionalAttributes): self
    {
        $this->mobAdditionalAttributes = $mobAdditionalAttributes;

        return $this;
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

    public function setMobFarmId(?string $mobFarmId): self
    {
        $this->mobFarmId = $mobFarmId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
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


    public function getProject(): ?string
    {
        return $this->project;
    }


    public function getMigrationId(): ?string
    {
        return $this->migrationId;
    }

    public function getFarm(): ?Farm
    {
        return $this->farm;
    }

    public  function getSpeciesId(): ?string
    {
        return $this->speciesId;
    }

    public function getFarmId(): ?int
    {
        return $this->farmId;
    }

}
