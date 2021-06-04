<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceBatchUploadDetailsSync
 *
 * @ORM\Table(name="interface_batch_upload_details_sync")
 * @ORM\Entity
 */
class InterfaceBatchUploadDetailsSync
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
     * @ORM\Column(name="sync_date", type="string", length=250, nullable=true)
     */
    private $syncDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sync_number", type="string", length=250, nullable=true)
     */
    private $syncNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hormone_type", type="string", length=250, nullable=true)
     */
    private $hormoneType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hormone_source", type="string", length=250, nullable=true)
     */
    private $hormoneSource;

    /**
     * @var string|null
     *
     * @ORM\Column(name="animal_parity", type="string", length=250, nullable=true)
     */
    private $animalParity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hormone_admin", type="string", length=250, nullable=true)
     */
    private $hormoneAdmin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="admin_name", type="string", length=250, nullable=true)
     */
    private $adminName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="admin_phone", type="string", length=250, nullable=true)
     */
    private $adminPhone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cost", type="string", length=250, nullable=true)
     */
    private $cost;

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

    public function getSyncDate(): ?string
    {
        return $this->syncDate;
    }

    public function setSyncDate(?string $syncDate): self
    {
        $this->syncDate = $syncDate;

        return $this;
    }

    public function getSyncNumber(): ?string
    {
        return $this->syncNumber;
    }

    public function setSyncNumber(?string $syncNumber): self
    {
        $this->syncNumber = $syncNumber;

        return $this;
    }

    public function getHormoneType(): ?string
    {
        return $this->hormoneType;
    }

    public function setHormoneType(?string $hormoneType): self
    {
        $this->hormoneType = $hormoneType;

        return $this;
    }

    public function getHormoneSource(): ?string
    {
        return $this->hormoneSource;
    }

    public function setHormoneSource(?string $hormoneSource): self
    {
        $this->hormoneSource = $hormoneSource;

        return $this;
    }

    public function getAnimalParity(): ?string
    {
        return $this->animalParity;
    }

    public function setAnimalParity(?string $animalParity): self
    {
        $this->animalParity = $animalParity;

        return $this;
    }

    public function getHormoneAdmin(): ?string
    {
        return $this->hormoneAdmin;
    }

    public function setHormoneAdmin(?string $hormoneAdmin): self
    {
        $this->hormoneAdmin = $hormoneAdmin;

        return $this;
    }

    public function getAdminName(): ?string
    {
        return $this->adminName;
    }

    public function setAdminName(?string $adminName): self
    {
        $this->adminName = $adminName;

        return $this;
    }

    public function getAdminPhone(): ?string
    {
        return $this->adminPhone;
    }

    public function setAdminPhone(?string $adminPhone): self
    {
        $this->adminPhone = $adminPhone;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(?string $cost): self
    {
        $this->cost = $cost;

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
