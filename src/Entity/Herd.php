<?php

namespace App\Entity;

use App\Entity\Traits\{AdditionalAttributesTrait,
    AdministrativeDivisionsTrait,
    CountryTrait,
    CreatedTrait,
    DataSourceTrait,
    IdentifiableTrait,
    MobAdditionalAttributesTrait,
    ODKIdentifiableTrait,
    OrganisationTrait,
    UpdatedTrait};
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Herd
 *
 * @ORM\Table(name="core_animal_herd", indexes={@ORM\Index(name="farm_id", columns={"farm_id"}), @ORM\Index(name="org_id", columns={"country_id"})})
 * @ORM\Entity(repositoryClass=HerdRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
#[ApiResource]
class Herd
{
    use AdministrativeDivisionsTrait;
    use AdditionalAttributesTrait;
    use MobAdditionalAttributesTrait;
    use CountryTrait;
    use CreatedTrait;
    use IdentifiableTrait;
    use ODKIdentifiableTrait;
    use OrganisationTrait;
    use UpdatedTrait;
    use DataSourceTrait;

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
     * @var Farm|null
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
     * @ORM\Column(name="species_id", type="integer", nullable=true)
     */
    private $speciesId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMobDataId(): ?string
    {
        return $this->mobDataId;
    }

    public function setMobDataId(?string $mobDataId): self
    {
        $this->mobDataId = $mobDataId;

        return $this;
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

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getMapAddress(): ?string
    {
        return $this->mapAddress;
    }

    public function setMapAddress(?string $mapAddress): self
    {
        $this->mapAddress = $mapAddress;

        return $this;
    }

    public function getLatlng(): ?string
    {
        return $this->latlng;
    }

    public function setLatlng(?string $latlng): self
    {
        $this->latlng = $latlng;

        return $this;
    }

    public function getRegDate(): ?\DateTimeInterface
    {
        return $this->regDate;
    }

    public function setRegDate(?\DateTimeInterface $regDate): self
    {
        $this->regDate = $regDate;

        return $this;
    }

    public function getProject(): ?string
    {
        return $this->project;
    }

    public function setProject(?string $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getMigrationId(): ?string
    {
        return $this->migrationId;
    }

    public function setMigrationId(?string $migrationId): self
    {
        $this->migrationId = $migrationId;

        return $this;
    }

    public function getFarm(): ?Farm
    {
        return $this->farm;
    }

    public function setFarm(?Farm $farm): self
    {
        $this->farm = $farm;

        return $this;
    }

    public function getSpeciesId(): ?int
    {
        return $this->speciesId;
    }

    public function setSpeciesId(?int $speciesId): self
    {
        $this->speciesId = $speciesId;

        return $this;
    }
}
