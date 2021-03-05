<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use App\Controller\MilkYieldController;
use App\Entity\Traits\{
    AdministrativeDivisionsTrait,
    CountryTrait,
    IdentifiableTrait
};
use Doctrine\ORM\Mapping as ORM;

/**
 * AnimalEvent
 *
 * @ApiResource(
 *     collectionOperations={
 *         "get"={
 *             "method"="GET",
 *             "normalization_context"={
 *                 "groups"={
 *                      "animalevent:collection:get"
 *                 }
 *             }
 *         },
 *         "post"={
 *             "method"="POST",
 *             "normalization_context"={
 *                 "groups"={
 *                      "animalevent:collection:post"
 *                 }
 *             }
 *         },
 *     },
 *     itemOperations={
 *         "get"={
 *             "method"="GET",
 *             "normalization_context"={
 *                 "groups"={
 *                      "animalevent:item:get"
 *                 }
 *             }
 *         },
 *         "put"={
 *             "method"="PUT",
 *             "normalization_context"={
 *                 "groups"={
 *                      "animalevent:item:put"
 *                 }
 *             }
 *         },
 *         "patch"={
 *             "method"="PATCH",
 *             "normalization_context"={
 *                 "groups"={
 *                      "animalevent:item:patch"
 *                 }
 *             }
 *         },
 *          "get",
 *          "get_milkyield"={
 *              "method"="GET",
 *                  "path"="/animal_events/{id}/milkyield",
 *                  "controller"=MilkYieldController::class,
 *                  "normalization_context"={
 *                      "groups"={
 *                              "animalevent:item:get"
 *                          }
 *                      },
 *                  }
 *              }
 *          ),
 *     }
 * )
 * @ApiFilter(
 *     SearchFilter::class,
 *     properties={
 *         "countryId": "exact",
 *         "eventType": "exact",
 *         "animal": "exact"
 *     }
 * )
 * @ApiFilter(
 *    DateFilter::class,
 *    properties={
 *         "eventDate"
 *    }
 * )
 * @ORM\Table(name="core_animal_event", indexes={@ORM\Index(name="animal_id", columns={"animal_id"}), @ORM\Index(name="country_id", columns={"country_id", "region_id", "district_id", "ward_id", "village_id"}), @ORM\Index(name="data_collection_date", columns={"data_collection_date"}), @ORM\Index(name="event_date", columns={"event_date"}), @ORM\Index(name="event_type", columns={"event_type"}), @ORM\Index(name="lactation_id", columns={"lactation_id"}), @ORM\Index(name="org_id", columns={"org_id", "client_id"})})
 * @ORM\Entity
 */
class AnimalEvent
{
    use IdentifiableTrait;
    use CountryTrait;
    use AdministrativeDivisionsTrait;

    const EVENT_TYPE_CALVING = 1;
    const EVENT_TYPE_MILKING = 2;
    const EVENT_TYPE_AI = 3;
    const EVENT_TYPE_PREGNANCY_DIAGNOSIS = 4;
    const EVENT_TYPE_SYNCHRONIZATION = 5;
    const EVENT_TYPE_WEIGHTS = 6;
    const EVENT_TYPE_HEALTH = 7;
    const EVENT_TYPE_EXITS = 9;
    const EVENT_TYPE_HAIR_SAMPLING = 10;
    const EVENT_TYPE_CERTIFICATION = 11;
    const EVENT_TYPE_VACCINATION = 12;
    const EVENT_TYPE_PARASITE_INFECTION = 13;
    const EVENT_TYPE_INJURY = 14;
    const EVENT_TYPE_HOOF_HEALTH = 15;
    const EVENT_TYPE_HOOF_TREATMENT = 16;

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
     * @ORM\Column(name="event_type", type="integer", nullable=false)
     */
    private $eventType;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="event_date", type="date", nullable=true)
     */
    private $eventDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_collection_date", type="date", nullable=true)
     */
    private $dataCollectionDate;

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
     * @var int|null
     *
     * @ORM\Column(name="field_agent_id", type="integer", nullable=true)
     */
    private $fieldAgentId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="lactation_id", type="integer", nullable=true, options={"comment"="lactation Id/Calving Id for milking record"})
     */
    private $lactationId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="lactation_number", type="integer", nullable=true, options={"comment"="lactation number for calving records"})
     */
    private $lactationNumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="testday_no", type="integer", nullable=true, options={"comment"="Test day number for milk record"})
     */
    private $testdayNo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="migration_id", type="string", length=255, nullable=true, options={"comment"="This is the migrationSouce plus primary key from migration source table of the record e.g KLBA_001"})
     */
    private $migrationId;

    /**
     * @var Animal
     *
     * @ORM\ManyToOne(targetEntity="Animal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="animal_id", referencedColumnName="id")
     * })
     */
    private $animal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventType(): ?int
    {
        return $this->eventType;
    }

    public function setEventType(int $eventType): self
    {
        $this->eventType = $eventType;

        return $this;
    }

    public function getEventDate(): ?\DateTimeInterface
    {
        return $this->eventDate;
    }

    public function setEventDate(?\DateTimeInterface $eventDate): self
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    public function getDataCollectionDate(): ?\DateTimeInterface
    {
        return $this->dataCollectionDate;
    }

    public function setDataCollectionDate(?\DateTimeInterface $dataCollectionDate): self
    {
        $this->dataCollectionDate = $dataCollectionDate;

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

    public function getFieldAgentId(): ?int
    {
        return $this->fieldAgentId;
    }

    public function setFieldAgentId(?int $fieldAgentId): self
    {
        $this->fieldAgentId = $fieldAgentId;

        return $this;
    }

    public function getLactationId(): ?int
    {
        return $this->lactationId;
    }

    public function setLactationId(?int $lactationId): self
    {
        $this->lactationId = $lactationId;

        return $this;
    }

    public function getLactationNumber(): ?int
    {
        return $this->lactationNumber;
    }

    public function setLactationNumber(?int $lactationNumber): self
    {
        $this->lactationNumber = $lactationNumber;

        return $this;
    }

    public function getTestdayNo(): ?int
    {
        return $this->testdayNo;
    }

    public function setTestdayNo(?int $testdayNo): self
    {
        $this->testdayNo = $testdayNo;

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

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }
}
