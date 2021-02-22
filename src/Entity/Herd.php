<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Herd
 *
 * @ApiResource(
 *     collectionOperations={
 *         "get"={
 *             "method"="GET",
 *             "normalization_context"={
 *                 "groups"={
 *                      "herd:collection:get"
 *                 }
 *             }
 *         },
 *         "post"={
 *             "method"="POST",
 *             "normalization_context"={
 *                 "groups"={
 *                      "herd:collection:post"
 *                 }
 *             }
 *         },
 *     },
 *     itemOperations={
 *         "get"={
 *             "method"="GET",
 *             "normalization_context"={
 *                 "groups"={
 *                      "herd:item:get"
 *                 }
 *             }
 *         },
 *         "put"={
 *             "method"="PUT",
 *             "normalization_context"={
 *                 "groups"={
 *                      "herd:item:put"
 *                 }
 *             }
 *         },
 *         "patch"={
 *             "method"="PATCH",
 *             "normalization_context"={
 *                 "groups"={
 *                      "herd:item:patch"
 *                 }
 *             }
 *         }
 *     }
 * )
 * @ORM\Table(name="core_animal_herd", indexes={@ORM\Index(name="farm_id", columns={"farm_id"}), @ORM\Index(name="org_id", columns={"country_id"})})
 * @ORM\Entity
 */
class Herd
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="uuid", type="string", length=128, nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $uuid;

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
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $regionId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="district_id", type="integer", nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $districtId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ward_id", type="integer", nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $wardId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="village_id", type="integer", nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $villageId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="org_id", type="integer", nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $orgId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="client_id", type="integer", nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $clientId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latitude", type="decimal", precision=13, scale=8, nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $latitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="longitude", type="decimal", precision=13, scale=8, nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $longitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="map_address", type="string", length=255, nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
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
     * @ORM\Column(name="project", type="string", length=128, nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $project;

    /**
     * @var array|null
     *
     * @ORM\Column(name="additional_attributes", type="json", nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $additionalAttributes;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @ORM\Version
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $createdBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $updatedAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $updatedBy;

    /**
     * @var string|null
     *
     * @ORM\Column(name="migration_id", type="string", length=255, nullable=true, options={"comment"="This is the migrationSouce plus primary key from migration source table of the record e.g KLBA_001"})
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $migrationId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="odk_form_uuid", type="string", length=128, nullable=true)
     *
     *  @Groups({
     *     "herd:collection:get",
     *     "herd:collection:post",
     *     "herd:item:get",
     *     "herd:item:put",
     *     "herd:item:patch"
     * })
     */
    private $odkFormUuid;

    /**
     * @var \CoreFarm
     *
     * @ORM\ManyToOne(targetEntity="Farm")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="farm_id", referencedColumnName="id")
     * })
     *
     *
     */
    private $farm;

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

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(?string $uuid): self
    {
        $this->uuid = $uuid;

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

    public function getFarm(): ?Farm
    {
        return $this->farm;
    }

    public function setFarm(?Farm $farm): self
    {
        $this->farm = $farm;

        return $this;
    }


}
