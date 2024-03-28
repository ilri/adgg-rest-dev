<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\AdditionalAttributesTrait;
use App\Entity\Traits\AdministrativeDivisionsTrait;
use App\Entity\Traits\CountryTrait;
use App\Entity\Traits\CreatedTrait;
use App\Entity\Traits\DataSourceTrait;
use App\Entity\Traits\ODKIdentifiableTrait;
use App\Repository\VactivefarmmetadataRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="v_active_core_farm_metadata", indexes={@ORM\Index(name="country_id", columns={"country_id"}), @ORM\Index(name="farm_id", columns={"farm_id"}), @ORM\Index(name="type", columns={"type"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass=VactivefarmmetadataRepository::class)
 */
#[ApiResource]
class VActiveCoreFarmMetadata
{
    use AdditionalAttributesTrait;
    use AdministrativeDivisionsTrait;
    use CountryTrait;
    use CreatedTrait;
    use ODKIdentifiableTrait;
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
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $farmMetadatatype;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mob_farm_metadata_data_id", type="string", nullable=true)
     */
    private $farmMetadataMobDataId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mob_form_event_data_id", type="string", nullable=true)
     */
    private $farmMetadataMobEventDataId;

    /**
     * @var string
     *
     * @ORM\Column(name="mob_additional_attributes", type="string", nullable=false)
     */
    private $farmMetadataMobAddtionalAttributes;

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
     * @var int|null
     *
     * @ORM\Column(name="farm_id", type="integer",nullable=true)
     *
     */
    private $farmId;

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

    public function getFarmMetadataMobDataId(): ?string
    {
        return $this->farmMetadataMobDataId;
    }

    public function setFarmMetadataMobDataId(?string $farmMetadataMobDataId): self
    {
        $this->farmMetadataMobDataId = $farmMetadataMobDataId;
        return $this;
    }

    public function getFarmMetadataMobAddtionalAttributes(): ?string
    {
        return $this->farmMetadataMobAddtionalAttributes;
    }

    public function setFarmMetadataMobAddtionalAttributes(?string $farmMetadataMobAddtionalAttributes): self
    {
        $this->farmMetadataMobAddtionalAttributes = $farmMetadataMobAddtionalAttributes;
        return $this;
    }

    public function getFarmMetadataMobEventDataId(): ?string
    {
        return $this->farmMetadataMobEventDataId;
    }

    public function setFarmMetadataMobEventDataId(?string $farmMetadataMobEventDataId): self
    {
        $this->farmMetadataMobEventDataId = $farmMetadataMobEventDataId;
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

    public function getFarmId(): int
    {
        return $this->farmId;
    }

    public function setFarmId(int $farmId): void
    {
        $this->farmId = $farmId;
    }
}
