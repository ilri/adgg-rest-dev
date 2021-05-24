<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\{
    ApiFilter,
    ApiResource
};
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\{
    DateFilter,
    SearchFilter
};
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
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
use App\EventListener\{
    LactationListener,
    MilkingEventListener
};
use App\Filter\CountryISOCodeFilter;
use App\Repository\AnimalEventRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * AnimalEvent
 *
 * @ApiResource(
 *     collectionOperations={
 *         "get": {
 *             "method": "GET",
 *             "normalization_context": {
 *                 "groups": {
 *                      "animalevent:collection:get"
 *                 }
 *             },
 *             "openapi_context": {
 *                 "parameters": {
 *                     {
 *                         "name": "animal",
 *                         "in": "query",
 *                         "description": "The path to a given animal resource<br><br> *For example: /api/animals/104359*",
 *                         "required": false,
 *                         "allowEmptyValue": true,
 *                         "schema": {
 *                            "type": "string",
 *                         },
 *                     },
 *                     {
 *                         "name": "animal[]",
 *                         "in": "query",
 *                         "description": "Select multiple animal resource paths",
 *                         "required": false,
 *                         "allowEmptyValue": true,
 *                         "schema": {
 *                             "type": "array",
 *                             "items": {
 *                                 "type": "string"
 *                             }
 *                         },
 *                         "explode": true,
 *                     },
 *                     {
 *                         "name": "eventDate[before]",
 *                         "in": "query",
 *                         "description": "Returns the animal event resoures occuring **before** or **on** a given event date<br><br>*For example: 2020-01-01*",
 *                         "required": false,
 *                         "allowEmptyValue": true,
 *                         "schema": {
 *                             "type": "string"
 *                         },
 *                     },
 *                     {
 *                         "name": "eventDate[strictly_before]",
 *                         "in": "query",
 *                         "description": "Returns the animal event resoures occuring strictly **before** (not including) a given event date",
 *                         "required": false,
 *                         "allowEmptyValue": true,
 *                         "schema": {
 *                             "type": "string"
 *                         },
 *                     },
 *                     {
 *                         "name": "eventDate[after]",
 *                         "in": "query",
 *                         "description": "Returns the animal event resoures occuring **after** or **on** a given event date",
 *                         "required": false,
 *                         "allowEmptyValue": true,
 *                         "schema": {
 *                             "type": "string"
 *                         },
 *                     },
 *                     {
 *                         "name": "eventDate[strictly_after]",
 *                         "in": "query",
 *                         "description": "Returns the animal event resoures occuring strictly **after** (not including) a given event date",
 *                         "required": false,
 *                         "allowEmptyValue": true,
 *                         "schema": {
 *                             "type": "string"
 *                         },
 *                     },
 *                     {
 *                         "name": "properties[]",
 *                         "in": "query",
 *                         "description": "Returns only selected properties of animal event resources<br><br>*For example: eventType*",
 *                         "required": false,
 *                         "allowEmptyValue": true,
 *                         "schema": {
 *                             "type": "array",
 *                             "items": {
 *                                 "type": "string"
 *                             }
 *                         },
 *                         "explode": true,
 *                     },
 *                 },
 *             },
 *         },
 *         "post": {
 *             "method": "POST",
 *             "denormalization_context": {
 *                 "groups": {
 *                     "animalevent:collection:post"
 *                 }
 *             },
 *             "openapi_context": {
 *                 "description": "<h3>Creates a AnimalEvent resource</h3><p>The following properties are **required** and need to be provided in the request body:
</p>`animal`<p>`countryId`</p>`eventDate`<p>`eventType`</p>
<p>All other properties are **optional**.</p>",
 *             },
 *         },
 *         "custom_events": {
 *             "method": "GET",
 *             "path": "/animal_events/{event_type}",
 *             "requirements": {
 *                 "event_type": "^[A-z]+\_events$",
 *             },
 *             "normalization_context": {
 *                 "groups": {
 *                     "animalevent:collection:get"
 *                 }
 *             },
 *             "openapi_context": {
 *                 "summary": "Retrieves a sub-collection of AnimalEvent resources by event type.",
 *                 "description": "Retrieves a sub-collection of AnimalEvent resources by event type.",
 *                 "parameters": {
 *                     {
 *                         "name": "event_type",
 *                         "in": "path",
 *                         "description": "The event type that animal events are filtered by.",
 *                         "required": true,
 *                         "schema": {
 *                             "type": "string",
 *                             "enum": {
 *                                 "ai_events", "calving_events", "certification_events", "exits_events",
 *                                 "hair_sampling_events", "health_events", "hoof_health_events", "hoof_treatment_events",
 *                                 "injury_events", "milking_events", "parasite_infection_events",
 *                                 "pregnancy_diagnosis_events", "synchronization_events", "vaccination_events",
 *                                 "weights_events"
 *                             },
 *                         },
 *                     },
{
 *                         "name": "animal",
 *                         "in": "query",
 *                         "description": "The API path to a given animal resource<br><br> *For example: /api/animals/104359*",
 *                         "required": false,
 *                         "allowEmptyValue": true,
 *                         "schema": {
 *                            "type": "string",
 *                         },
 *                     },
 *                     {
 *                         "name": "animal[]",
 *                         "in": "query",
 *                         "description": "The API paths to animal resources",
 *                         "required": false,
 *                         "allowEmptyValue": true,
 *                         "schema": {
 *                             "type": "array",
 *                             "items": {
 *                                 "type": "string"
 *                             }
 *                         },
 *                         "explode": true,
 *                     },
 *                     {
 *                         "name": "eventDate[before]",
 *                         "in": "query",
 *                         "description": "Returns the animal event resoures occuring **before** or **on** a given event date<br><br>*For example: 2020-01-01*",
 *                         "required": false,
 *                         "allowEmptyValue": true,
 *                         "schema": {
 *                             "type": "string"
 *                         },
 *                     },
 *                     {
 *                         "name": "eventDate[strictly_before]",
 *                         "in": "query",
 *                         "description": "Returns the animal event resoures occuring strictly **before** (not including) a given event date",
 *                         "required": false,
 *                         "allowEmptyValue": true,
 *                         "schema": {
 *                             "type": "string"
 *                         },
 *                     },
 *                     {
 *                         "name": "eventDate[after]",
 *                         "in": "query",
 *                         "description": "Returns the animal event resoures occuring **after** or **on** a given event date",
 *                         "required": false,
 *                         "allowEmptyValue": true,
 *                         "schema": {
 *                             "type": "string"
 *                         },
 *                     },
 *                     {
 *                         "name": "eventDate[strictly_after]",
 *                         "in": "query",
 *                         "description": "Returns the animal event resoures occuring strictly **after** (not including) a given event date",
 *                         "required": false,
 *                         "allowEmptyValue": true,
 *                         "schema": {
 *                             "type": "string"
 *                         },
 *                     },
 *                     {
 *                         "name": "properties[]",
 *                         "in": "query",
 *                         "description": "Returns only selected properties of animal event resources<br><br>*For example: eventType*",
 *                         "required": false,
 *                         "allowEmptyValue": true,
 *                         "schema": {
 *                             "type": "array",
 *                             "items": {
 *                                 "type": "string"
 *                             }
 *                         },
 *                         "explode": true,
 *                     },
 *                 }
 *             },
 *         },
 *     },
 *     itemOperations= {
 *         "get": {
 *             "method": "GET",
 *             "normalization_context": {
 *                 "groups": {
 *                     "animalevent:item:get"
 *                 }
 *             }
 *         },
 *         "put": {
 *             "method": "PUT",
 *             "denormalization_context": {
 *                 "groups": {
 *                     "animalevent:item:put"
 *                 }
 *             },
 *             "openapi_context": {
 *                 "description": "<h3>Replaces the AnimalEvent resource specified by the `id` parameter</h3><p>The following properties are **required** and need to be provided in the request body:
</p>`animal`<p>`countryId`</p>`eventDate`<p>`eventType`</p>
<p>All other properties are **optional**.</p>",
 *              },
 *         },
 *         "patch": {
 *             "method": "PATCH",
 *             "denormalization_context": {
 *                 "groups": {
 *                     "animalevent:item:patch"
 *                 }
 *             },
 *             "openapi_context": {
 *                 "description": "<h3>Updates the AnimalEvent resource specified by the `id` parameter</h3><p>The following properties are **required** and need to be provided in the request body:
</p>`animal`<p>`countryId`</p>`eventDate`<p>`eventType`</p>
<p>All other properties are **optional**.</p>",
 *             },
 *         }
 *     }
 * )
 * @ApiFilter(
 *     SearchFilter::class,
 *     properties={
 *         "animal": "exact"
 *     }
 * )
 * @ApiFilter(
 *     DateFilter::class,
 *     properties={
 *         "eventDate"
 *     }
 * )
 * @ApiFilter(
 *     PropertyFilter::class
 * )
 * @ApiFilter(
 *     CountryISOCodeFilter::class
 * )
 * @ORM\Table(name="core_animal_event", indexes={@ORM\Index(name="animal_id", columns={"animal_id"}), @ORM\Index(name="country_id", columns={"country_id", "region_id", "district_id", "ward_id", "village_id"}), @ORM\Index(name="data_collection_date", columns={"data_collection_date"}), @ORM\Index(name="event_date", columns={"event_date"}), @ORM\Index(name="event_type", columns={"event_type"}), @ORM\Index(name="lactation_id", columns={"lactation_id"}), @ORM\Index(name="org_id", columns={"org_id", "client_id"})})
 * @ORM\EntityListeners({LactationListener::class, MilkingEventListener::class})
 * @ORM\Entity(repositoryClass=AnimalEventRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class AnimalEvent
{
    use AdministrativeDivisionsTrait;
    use AdditionalAttributesTrait;
    use CountryTrait;
    use CreatedTrait;
    use IdentifiableTrait;
    use ODKIdentifiableTrait;
    use OrganisationTrait;
    use UpdatedTrait;

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
     * @ORM\ManyToOne(targetEntity="Animal", inversedBy="animalEvents")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="animal_id", referencedColumnName="id")
     * })
     */
    private $animal;

    /**
     * @var MilkYieldRecord
     */
    private $milkYieldRecord;

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

    public function getMilkYieldRecord(): ?MilkYieldRecord
    {
        return $this->milkYieldRecord;
    }

    public function setMilkYieldRecord(?MilkYieldRecord $milkYieldRecord): self
    {
        $this->milkYieldRecord = $milkYieldRecord;

        return $this;
    }
}
