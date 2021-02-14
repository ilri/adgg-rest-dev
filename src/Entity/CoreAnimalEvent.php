<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * CoreAnimalEvent
 *
 * @ApiResource()
 * @ORM\Table(name="core_animal_event", indexes={@ORM\Index(name="animal_id", columns={"animal_id"}), @ORM\Index(name="country_id", columns={"country_id", "region_id", "district_id", "ward_id", "village_id"}), @ORM\Index(name="data_collection_date", columns={"data_collection_date"}), @ORM\Index(name="event_date", columns={"event_date"}), @ORM\Index(name="event_type", columns={"event_type"}), @ORM\Index(name="lactation_id", columns={"lactation_id"}), @ORM\Index(name="org_id", columns={"org_id", "client_id"})})
 * @ORM\Entity
 */
class CoreAnimalEvent
{
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
     * @var int
     *
     * @ORM\Column(name="country_id", type="integer", nullable=false)
     */
    private $countryId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="region_id", type="integer", nullable=true)
     */
    private $regionId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="district_id", type="integer", nullable=true)
     */
    private $districtId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ward_id", type="integer", nullable=true)
     */
    private $wardId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="village_id", type="integer", nullable=true)
     */
    private $villageId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="org_id", type="integer", nullable=true)
     */
    private $orgId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="client_id", type="integer", nullable=true)
     */
    private $clientId;

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
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=255, nullable=false)
     */
    private $uuid;

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
     * @var array|null
     *
     * @ORM\Column(name="additional_attributes", type="json", nullable=true)
     */
    private $additionalAttributes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=true)
     */
    private $updatedBy;

    /**
     * @var string|null
     *
     * @ORM\Column(name="migration_id", type="string", length=255, nullable=true, options={"comment"="This is the migrationSouce plus primary key from migration source table of the record e.g KLBA_001"})
     */
    private $migrationId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="odk_form_uuid", type="string", length=128, nullable=true)
     */
    private $odkFormUuid;

    /**
     * @var \CoreAnimal
     *
     * @ORM\ManyToOne(targetEntity="CoreAnimal")
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

    public function getCountryId(): ?int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): self
    {
        $this->countryId = $countryId;

        return $this;
    }

    public function getRegionId(): ?int
    {
        return $this->regionId;
    }

    public function setRegionId(?int $regionId): self
    {
        $this->regionId = $regionId;

        return $this;
    }

    public function getDistrictId(): ?int
    {
        return $this->districtId;
    }

    public function setDistrictId(?int $districtId): self
    {
        $this->districtId = $districtId;

        return $this;
    }

    public function getWardId(): ?int
    {
        return $this->wardId;
    }

    public function setWardId(?int $wardId): self
    {
        $this->wardId = $wardId;

        return $this;
    }

    public function getVillageId(): ?int
    {
        return $this->villageId;
    }

    public function setVillageId(?int $villageId): self
    {
        $this->villageId = $villageId;

        return $this;
    }

    public function getOrgId(): ?int
    {
        return $this->orgId;
    }

    public function setOrgId(?int $orgId): self
    {
        $this->orgId = $orgId;

        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function setClientId(?int $clientId): self
    {
        $this->clientId = $clientId;

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

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

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

    public function getAdditionalAttributes(): ?array
    {
        return $this->additionalAttributes;
    }

    public function setAdditionalAttributes(?array $additionalAttributes): self
    {
        $this->additionalAttributes = $additionalAttributes;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?int $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?int $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

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

    public function getOdkFormUuid(): ?string
    {
        return $this->odkFormUuid;
    }

    public function setOdkFormUuid(?string $odkFormUuid): self
    {
        $this->odkFormUuid = $odkFormUuid;

        return $this;
    }

    public function getAnimal(): ?CoreAnimal
    {
        return $this->animal;
    }

    public function setAnimal(?CoreAnimal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }


}
