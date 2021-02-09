<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceAiStraws
 *
 * @ORM\Table(name="interface_ai_straws")
 * @ORM\Entity
 */
class InterfaceAiStraws
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="straw_id", type="string", length=255, nullable=true)
     */
    private $strawId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="barcode", type="string", length=255, nullable=true)
     */
    private $barcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bull_tag_id", type="string", length=255, nullable=true)
     */
    private $bullTagId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bull_name", type="string", length=255, nullable=true)
     */
    private $bullName;

    /**
     * @var int|null
     *
     * @ORM\Column(name="breed", type="integer", nullable=true)
     */
    private $breed;

    /**
     * @var int|null
     *
     * @ORM\Column(name="breed_composition", type="integer", nullable=true)
     */
    private $breedComposition;

    /**
     * @var int|null
     *
     * @ORM\Column(name="semen_source", type="integer", nullable=true)
     */
    private $semenSource;

    /**
     * @var int|null
     *
     * @ORM\Column(name="origin_country", type="integer", nullable=true)
     */
    private $originCountry;

    /**
     * @var string|null
     *
     * @ORM\Column(name="farm_name", type="string", length=255, nullable=true)
     */
    private $farmName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="batch_number", type="string", length=255, nullable=true)
     */
    private $batchNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ejaculation_number", type="string", length=255, nullable=true)
     */
    private $ejaculationNumber;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="production_date", type="datetime", nullable=true)
     */
    private $productionDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="specification", type="string", length=10, nullable=true)
     */
    private $specification;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true, options={"default"="1"})
     */
    private $isActive = true;

    /**
     * @var string|null
     *
     * @ORM\Column(name="additional_info", type="string", length=255, nullable=true)
     */
    private $additionalInfo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="org_id", type="integer", nullable=true)
     */
    private $orgId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=true)
     */
    private $updatedBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStrawId(): ?string
    {
        return $this->strawId;
    }

    public function setStrawId(?string $strawId): self
    {
        $this->strawId = $strawId;

        return $this;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(?string $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getBullTagId(): ?string
    {
        return $this->bullTagId;
    }

    public function setBullTagId(?string $bullTagId): self
    {
        $this->bullTagId = $bullTagId;

        return $this;
    }

    public function getBullName(): ?string
    {
        return $this->bullName;
    }

    public function setBullName(?string $bullName): self
    {
        $this->bullName = $bullName;

        return $this;
    }

    public function getBreed(): ?int
    {
        return $this->breed;
    }

    public function setBreed(?int $breed): self
    {
        $this->breed = $breed;

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

    public function getSemenSource(): ?int
    {
        return $this->semenSource;
    }

    public function setSemenSource(?int $semenSource): self
    {
        $this->semenSource = $semenSource;

        return $this;
    }

    public function getOriginCountry(): ?int
    {
        return $this->originCountry;
    }

    public function setOriginCountry(?int $originCountry): self
    {
        $this->originCountry = $originCountry;

        return $this;
    }

    public function getFarmName(): ?string
    {
        return $this->farmName;
    }

    public function setFarmName(?string $farmName): self
    {
        $this->farmName = $farmName;

        return $this;
    }

    public function getBatchNumber(): ?string
    {
        return $this->batchNumber;
    }

    public function setBatchNumber(?string $batchNumber): self
    {
        $this->batchNumber = $batchNumber;

        return $this;
    }

    public function getEjaculationNumber(): ?string
    {
        return $this->ejaculationNumber;
    }

    public function setEjaculationNumber(?string $ejaculationNumber): self
    {
        $this->ejaculationNumber = $ejaculationNumber;

        return $this;
    }

    public function getProductionDate(): ?\DateTimeInterface
    {
        return $this->productionDate;
    }

    public function setProductionDate(?\DateTimeInterface $productionDate): self
    {
        $this->productionDate = $productionDate;

        return $this;
    }

    public function getSpecification(): ?string
    {
        return $this->specification;
    }

    public function setSpecification(?string $specification): self
    {
        $this->specification = $specification;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getAdditionalInfo(): ?string
    {
        return $this->additionalInfo;
    }

    public function setAdditionalInfo(?string $additionalInfo): self
    {
        $this->additionalInfo = $additionalInfo;

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

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?int $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


}
