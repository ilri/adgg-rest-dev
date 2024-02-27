<?php

namespace App\Entity;

use App\Entity\Traits\{
    AdditionalAttributesTrait,
    CountryTrait,
    CreatedTrait,
    ODKIdentifiableTrait
};
use Doctrine\ORM\Mapping as ORM;

/**
 * FarmMetadata
 *
 * @ORM\Table(name="core_farm_metadata", indexes={@ORM\Index(name="country_id", columns={"country_id"}), @ORM\Index(name="farm_id", columns={"farm_id"}), @ORM\Index(name="type", columns={"type"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FarmMetadata
{
    use AdditionalAttributesTrait;
    use CountryTrait;
    use CreatedTrait;
    use ODKIdentifiableTrait;

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
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $farmMetadatatype;

    /**
     * @var Farm
     *
     * @ORM\ManyToOne(targetEntity="Farm")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="farm_id", referencedColumnName="id")
     * })
     */
    private $farm;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFarmMetadatatype(): ?int
    {
        return $this->farmMetadatatype;
    }

    public function setFarmMetadatatype(int $farmMetadatatype): self
    {
        $this->farmMetadatatype = $farmMetadatatype;

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
