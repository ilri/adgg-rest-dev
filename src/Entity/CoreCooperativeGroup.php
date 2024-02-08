<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\CreatedTrait;
use App\Repository\CoreCooperativeGroupRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="core_cooperative_group")
 * @ORM\Entity(repositoryClass=CoreCooperativeGroupRepository::class)
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
     * @var string|null
     *
     * @ORM\Column(name="mob_data_id",  type="string", length=250)
     */
    private $mob_data_id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cooperative_group_name", type="string", length=255, nullable=true)
     */
    private $cooperative_group_name;

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
    private $cooperative_group_type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cooperative_group_function", type="string", length=100, nullable=true)
     */
    private $cooperative_group_function;

    /**
     * @var string|null
     *
     * @ORM\Column(name="offers_livestock_marketing", type="string", length=100, nullable=true)
     */
    private $offers_livestock_marketing;

    /**
     * @var string|null
     *
     * @ORM\Column(name="offers_livestock_products",  type="string", length=100, nullable=true)
     */
    private $offers_livestock_products;

    /**
     * @var string|null
     *
     * @ORM\Column(name="number_male_members", type="string", length=50, nullable=true)
     */
    private $number_male_members;

    /**
     * @var string|null
     *
     * @ORM\Column(name="number_female_members", type="string", length=50, nullable=true)
     */
    private $number_female_members;

    /**
     * @var integer|null
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $user_id;

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


    public function getIsGroup(): ?int
    {
        return $this->isGroup;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMobDataId(): ?string
    {
        return $this->mob_data_id;
    }

    public function setMobDataId(string $mob_data_id): self
    {
        $this->mob_data_id = $mob_data_id;

        return $this;
    }

    public function getCooperativeGroupName(): ?string
    {
        return $this->cooperative_group_name;
    }

    public function setCooperativeGroupName(?string $cooperative_group_name): self
    {
        $this->cooperative_group_name = $cooperative_group_name;

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
        return $this->cooperative_group_type;
    }

    public function setCooperativeGroupType(?string $cooperative_group_type): self
    {
        $this->cooperative_group_type = $cooperative_group_type;

        return $this;
    }

    public function getCooperativeGroupFunction(): ?string
    {
        return $this->cooperative_group_function;
    }

    public function setCooperativeGroupFunction(?string $cooperative_group_function): self
    {
        $this->cooperative_group_function = $cooperative_group_function;

        return $this;
    }

    public function getOffersLivestockMarketing(): ?string
    {
        return $this->offers_livestock_marketing;
    }

    public function setOffersLivestockMarketing(?string $offers_livestock_marketing): self
    {
        $this->offers_livestock_marketing = $offers_livestock_marketing;

        return $this;
    }

    public function getOffersLivestockProducts(): ?string
    {
        return $this->offers_livestock_products;
    }

    public function setOffersLivestockProducts(?string $offers_livestock_products): self
    {
        $this->offers_livestock_products = $offers_livestock_products;

        return $this;
    }

    public function getNumberMaleMembers(): ?string
    {
        return $this->number_male_members;
    }

    public function setNumberMaleMembers(?string $number_male_members): self
    {
        $this->number_male_members = $number_male_members;

        return $this;
    }

    public function getNumberFemaleMembers(): ?string
    {
        return $this->number_female_members;
    }

    public function setNumberFemaleMembers(?string $number_female_members): self
    {
        $this->number_female_members = $number_female_members;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): self
    {
        $this->user_id = $user_id;

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
