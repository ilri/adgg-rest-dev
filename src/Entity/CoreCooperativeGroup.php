<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\CreatedTrait;
use App\Repository\CoreCooperativeGroupRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="core_cooperative_group")
 * @ORM\Entity(repositoryClass=CoreCooperativeGroupRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
#[ApiResource]
class CoreCooperativeGroup
{
    use CreatedTrait;
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int|string|null
     *
     * @ORM\Column(name="mob_data_id",  type="string", length=250, nullable=true)
     */
    private $mobDataId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cooperative_group_name", type="string", length=255, nullable=true)
     */
    private $cooperativeGroupName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=100, nullable=true)
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cooperative_group_type", type="string", length=100, nullable=true)
     */
    private $cooperativeGroupType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cooperative_group_function", type="string", length=100, nullable=true)
     */
    private $cooperativeGroupFunction;

    /**
     * @var string|null
     *
     * @ORM\Column(name="offers_livestock_marketing", type="string", length=100, nullable=true)
     */
    private $offersLivestockMarketing;

    /**
     * @var string|null
     *
     * @ORM\Column(name="offers_livestock_products",  type="string", length=100, nullable=true)
     */
    private $offersLivestockProducts;

    /**
     * @var string|null
     *
     * @ORM\Column(name="number_male_members", type="string", length=50, nullable=true)
     */
    private $numberMaleMembers;

    /**
     * @var string|null
     *
     * @ORM\Column(name="number_female_members", type="string", length=50, nullable=true)
     */
    private $numberFemaleMembers;

    /**
     * @var integer|null
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var | string
     *
     * @ORM\Column(name="datetime", type="string", nullable=true)
     */
    private $datetime;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ip_address", type="string", length=100, nullable=true)
     */
    private $ipAddress;

    /**
     * @var integer|null
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

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
     * @var int|null
     *
     * @ORM\Column(name="country_id", type="integer", nullable=false)
     */
    private $countryId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="state_id", type="integer", nullable=true)
     */
    private $regionId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="dist_id", type="integer", nullable=true)
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

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIsCooperative(): ?int
    {
        return $this->isCooperative;
    }

    public function setIsCooperative(string $isCooperative): self
    {
        $this->isCooperative = $isCooperative;

        return $this;
    }


    public function getIsGroup(): ?int
    {
        return $this->isGroup;
    }

    public function setIsGroup(int $isGroup): self
    {
        $this->isGroup = $isGroup;

        return $this;
    }


    public function getMobDataId(): ?string
    {
        return $this->mobDataId;
    }

    public function setMobDataId(string $mobDataId): self
    {
        $this->mobDataId = $mobDataId;

        return $this;
    }

    public function getCooperativeGroupName(): ?string
    {
        return $this->cooperativeGroupName;
    }

    public function setCooperativeGroupName(?string $cooperativeGroupName): self
    {
        $this->cooperativeGroupName = $cooperativeGroupName;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCooperativeGroupType(): ?string
    {
        return $this->cooperativeGroupType;
    }

    public function setCooperativeGroupType(?string $cooperativeGroupType): self
    {
        $this->cooperativeGroupType = $cooperativeGroupType;

        return $this;
    }

    public function getCooperativeGroupFunction(): ?string
    {
        return $this->cooperativeGroupFunction;
    }

    public function setCooperativeGroupFunction(?string $cooperativeGroupFunction): self
    {
        $this->cooperativeGroupFunction = $cooperativeGroupFunction;

        return $this;
    }

    public function getOffersLivestockMarketing(): ?string
    {
        return $this->offersLivestockMarketing;
    }

    public function setOffersLivestockMarketing(?string $offersLivestockMarketing): self
    {
        $this->offersLivestockMarketing = $offersLivestockMarketing;

        return $this;
    }

    public function getOffersLivestockProducts(): ?string
    {
        return $this->offersLivestockProducts;
    }

    public function setOffersLivestockProducts(?string $offersLivestockProducts): self
    {
        $this->offersLivestockProducts = $offersLivestockProducts;

        return $this;
    }

    public function getNumberMaleMembers(): ?string
    {
        return $this->numberMaleMembers;
    }

    public function setNumberMaleMembers(?string $numberMaleMembers): self
    {
        $this->numberMaleMembers = $numberMaleMembers;

        return $this;
    }

    public function getNumberFemaleMembers(): ?string
    {
        return $this->numberFemaleMembers;
    }

    public function setNumberFemaleMembers(?string $numberFemaleMembers): self
    {
        $this->numberFemaleMembers = $numberFemaleMembers;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getDatetime(): ?string
    {
        return $this->datetime;
    }

    public function setDatetime(?string $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    public function setIpAddress(?string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

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

}
