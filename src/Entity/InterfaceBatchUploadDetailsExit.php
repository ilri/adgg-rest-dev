<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceBatchUploadDetailsExit
 *
 * @ORM\Table(name="interface_batch_upload_details_exit")
 * @ORM\Entity
 */
class InterfaceBatchUploadDetailsExit
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
     * @ORM\Column(name="uuid", type="string", length=250, nullable=true)
     */
    private $uuid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="animal_id", type="string", length=250, nullable=true)
     */
    private $animalId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="exit_date", type="string", length=250, nullable=true)
     */
    private $exitDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="disposal_reason", type="string", length=250, nullable=true)
     */
    private $disposalReason;

    /**
     * @var string|null
     *
     * @ORM\Column(name="disposal_amount", type="string", length=250, nullable=true)
     */
    private $disposalAmount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_farmer_name", type="string", length=250, nullable=true)
     */
    private $newFarmerName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_farmer_phone_number", type="string", length=250, nullable=true)
     */
    private $newFarmerPhoneNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_breeder_name", type="string", length=250, nullable=true)
     */
    private $newBreederName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_breeder_phone_number", type="string", length=250, nullable=true)
     */
    private $newBreederPhoneNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_country", type="string", length=250, nullable=true)
     */
    private $newCountry;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_region", type="string", length=250, nullable=true)
     */
    private $newRegion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_district", type="string", length=250, nullable=true)
     */
    private $newDistrict;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_ward", type="string", length=250, nullable=true)
     */
    private $newWard;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_village", type="string", length=250, nullable=true)
     */
    private $newVillage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="status", type="integer", nullable=true, options={"default"="1"})
     */
    private $status = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="notes", type="string", length=250, nullable=true)
     */
    private $notes;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAnimalId(): ?string
    {
        return $this->animalId;
    }

    public function setAnimalId(?string $animalId): self
    {
        $this->animalId = $animalId;

        return $this;
    }

    public function getExitDate(): ?string
    {
        return $this->exitDate;
    }

    public function setExitDate(?string $exitDate): self
    {
        $this->exitDate = $exitDate;

        return $this;
    }

    public function getDisposalReason(): ?string
    {
        return $this->disposalReason;
    }

    public function setDisposalReason(?string $disposalReason): self
    {
        $this->disposalReason = $disposalReason;

        return $this;
    }

    public function getDisposalAmount(): ?string
    {
        return $this->disposalAmount;
    }

    public function setDisposalAmount(?string $disposalAmount): self
    {
        $this->disposalAmount = $disposalAmount;

        return $this;
    }

    public function getNewFarmerName(): ?string
    {
        return $this->newFarmerName;
    }

    public function setNewFarmerName(?string $newFarmerName): self
    {
        $this->newFarmerName = $newFarmerName;

        return $this;
    }

    public function getNewFarmerPhoneNumber(): ?string
    {
        return $this->newFarmerPhoneNumber;
    }

    public function setNewFarmerPhoneNumber(?string $newFarmerPhoneNumber): self
    {
        $this->newFarmerPhoneNumber = $newFarmerPhoneNumber;

        return $this;
    }

    public function getNewBreederName(): ?string
    {
        return $this->newBreederName;
    }

    public function setNewBreederName(?string $newBreederName): self
    {
        $this->newBreederName = $newBreederName;

        return $this;
    }

    public function getNewBreederPhoneNumber(): ?string
    {
        return $this->newBreederPhoneNumber;
    }

    public function setNewBreederPhoneNumber(?string $newBreederPhoneNumber): self
    {
        $this->newBreederPhoneNumber = $newBreederPhoneNumber;

        return $this;
    }

    public function getNewCountry(): ?string
    {
        return $this->newCountry;
    }

    public function setNewCountry(?string $newCountry): self
    {
        $this->newCountry = $newCountry;

        return $this;
    }

    public function getNewRegion(): ?string
    {
        return $this->newRegion;
    }

    public function setNewRegion(?string $newRegion): self
    {
        $this->newRegion = $newRegion;

        return $this;
    }

    public function getNewDistrict(): ?string
    {
        return $this->newDistrict;
    }

    public function setNewDistrict(?string $newDistrict): self
    {
        $this->newDistrict = $newDistrict;

        return $this;
    }

    public function getNewWard(): ?string
    {
        return $this->newWard;
    }

    public function setNewWard(?string $newWard): self
    {
        $this->newWard = $newWard;

        return $this;
    }

    public function getNewVillage(): ?string
    {
        return $this->newVillage;
    }

    public function setNewVillage(?string $newVillage): self
    {
        $this->newVillage = $newVillage;

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

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }


}
