<?php

namespace App\Entity;

use App\Entity\Traits\{
    AdditionalAttributesTrait,
    AdministrativeDivisionsTrait,
    CountryTrait,
    CreatedTrait,
    IdentifiableTrait,
    ODKIdentifiableTrait,
    OrganisationTrait,
    UpdatedTrait
};
use App\Repository\AnimalRepository;
use Carbon\Carbon;
use Doctrine\Common\Collections\{
    ArrayCollection,
    Collection
};
use Doctrine\ORM\Mapping as ORM;

/**
 * Animal
 *
 * @ORM\Table(name="core_animal", indexes={@ORM\Index(name="animal_type", columns={"animal_type"}), @ORM\Index(name="country_id", columns={"country_id", "region_id", "district_id", "ward_id", "village_id"}), @ORM\Index(name="dam_id", columns={"dam_id"}), @ORM\Index(name="farm_id", columns={"farm_id"}), @ORM\Index(name="org_id", columns={"org_id", "client_id"}), @ORM\Index(name="reg_date", columns={"reg_date"}), @ORM\Index(name="sire_id", columns={"sire_id"}), @ORM\Index(name="tag_id", columns={"tag_id"})})
 * @ORM\Entity(repositoryClass=AnimalRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Animal
{
    use AdministrativeDivisionsTrait;
//    use AdditionalAttributesTrait;
    use CountryTrait;
    use CreatedTrait;
    use IdentifiableTrait;
    use ODKIdentifiableTrait;
    use OrganisationTrait;
    use UpdatedTrait;

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
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AnimalEvent", mappedBy="animal")
     * @ORM\OrderBy({"eventDate" = "DESC"})
     */
    private $animalEvents;

    public function __construct()
    {
        $this->animalEvents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTagId(): ?string
    {
        return $this->tagId;
    }

    public function setTagId(?string $tagId): self
    {
        $this->tagId = $tagId;

        return $this;
    }

    public function getHerdId(): ?int
    {
        return $this->herdId;
    }

    public function setHerdId(?int $herdId): self
    {
        $this->herdId = $herdId;

        return $this;
    }

    public function getAnimalType(): ?int
    {
        return $this->animalType;
    }

    public function setAnimalType(?int $animalType): self
    {
        $this->animalType = $animalType;

        return $this;
    }

    public function getSex(): ?int
    {
        return $this->sex;
    }

    public function setSex(?int $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getSireType(): ?int
    {
        return $this->sireType;
    }

    public function setSireType(?int $sireType): self
    {
        $this->sireType = $sireType;

        return $this;
    }

    public function getSireId(): ?int
    {
        return $this->sireId;
    }

    public function setSireId(?int $sireId): self
    {
        $this->sireId = $sireId;

        return $this;
    }

    public function getSireTagId(): ?string
    {
        return $this->sireTagId;
    }

    public function setSireTagId(?string $sireTagId): self
    {
        $this->sireTagId = $sireTagId;

        return $this;
    }

    public function getDamId(): ?int
    {
        return $this->damId;
    }

    public function setDamId(?int $damId): self
    {
        $this->damId = $damId;

        return $this;
    }

    public function getDamTagId(): ?string
    {
        return $this->damTagId;
    }

    public function setDamTagId(?string $damTagId): self
    {
        $this->damTagId = $damTagId;

        return $this;
    }

    public function getMainBreed(): ?int
    {
        return $this->mainBreed;
    }

    public function setMainBreed(?int $mainBreed): self
    {
        $this->mainBreed = $mainBreed;

        return $this;
    }

    public function getBreedComposition(): ?int
    {
        return $this->breedComposition;
    }

    public function setBreedComposition(?int $breedComposition): self
    {
        $this->breedComposition = $breedComposition;

        return $this;
    }

    public function getAnimalPhoto(): ?string
    {
        return $this->animalPhoto;
    }

    public function setAnimalPhoto(?string $animalPhoto): self
    {
        $this->animalPhoto = $animalPhoto;

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

    public function getHairSampleId(): ?string
    {
        return $this->hairSampleId;
    }

    public function setHairSampleId(?string $hairSampleId): self
    {
        $this->hairSampleId = $hairSampleId;

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

    public function getOdkAnimalCode(): ?string
    {
        return $this->odkAnimalCode;
    }

    public function setOdkAnimalCode(?string $odkAnimalCode): self
    {
        $this->odkAnimalCode = $odkAnimalCode;

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

    /**
     * @return Collection|AnimalEvent[]
     */
    public function getAnimalEvents(): Collection
    {
        return $this->animalEvents;
    }

    public function addAnimalEvent(AnimalEvent $animalEvent): self
    {
        if (!$this->animalEvents->contains($animalEvent)) {
            $this->animalEvents[] = $animalEvent;
            $animalEvent->setAnimal($this);
        }

        return $this;
    }

    public function removeAnimalEvent(AnimalEvent $animalEvent): self
    {
        if ($this->animalEvents->contains($animalEvent)) {
            $this->animalEvents->removeElement($animalEvent);
            // set the owning side to null (unless already changed)
            if ($animalEvent->getAnimal() === $this) {
                $animalEvent->setAnimal(null);
            }
        }

        return $this;
    }

    /**
     * @return AnimalEvent|null
     */
    public function getLastCalving(): ?AnimalEvent
    {
        $events = $this->getAnimalEvents()->filter(function (AnimalEvent $element) {
            return $element->getEventType() == AnimalEvent::EVENT_TYPE_CALVING;
        });
        return $events->first() ?: null;
    }

    /**
     * @return array
     */
    public function getCalvingInterval(): array
    {
        $lastCalving = $this->getLastCalving();
        $days = null;
        $alarm = null;
        if ($lastCalving) {
            $days = Carbon::now()->diff($this->getLastCalving()->getEventDate())->days;
        }
        if ($days) {
            $alarm = $days > 365;
        }

        return [
            'days_since_last_calving' => $days,
            'alarm' => $alarm,
        ];
    }

    /**
     * @return Collection
     */
    public function getMilkingEvents(): Collection
    {
        return $this->getAnimalEvents()->filter(function (AnimalEvent $element) {
            return $element->getEventType() == AnimalEvent::EVENT_TYPE_MILKING;
        });
    }

    /**
     * @return AnimalEvent|null
     */
    public function getLastMilkingEvent(): ?AnimalEvent
    {
        $events = $this->getMilkingEvents();
        return $events->first() ?: null;
    }

    /**
     * @return float|null
     */
    public function getAverageMilkYield(): ?float
    {
        $milkingEvents = $this->getMilkingEvents();
        $func = function($event) {
            if ($event->getMilkYieldRecord()) {
                return $event->getMilkYieldRecord()->getTotalMilkRecord();
            }
            return null;
        };
        $milkYieldRecords = array_map($func, $milkingEvents->toArray());
        if (count($milkingEvents)) {
            return array_sum($milkYieldRecords) / count($milkingEvents);
        }
        return null;
    }
}
