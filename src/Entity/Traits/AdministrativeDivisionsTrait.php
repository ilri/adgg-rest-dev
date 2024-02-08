<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait AdministrativeDivisionsTrait
{
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
