<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="core_country")
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 */
class Country
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=128, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=3, nullable=false)
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_person", type="string", length=30, nullable=true)
     */
    private $contactPerson;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_phone", type="string", length=20, nullable=true)
     */
    private $contactPhone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_email", type="string", length=255, nullable=true)
     */
    private $contactEmail;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isActive = true;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=255, nullable=false)
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(name="unit1_name", type="string", length=30, nullable=false)
     */
    private $unit1Name;

    /**
     * @var string
     *
     * @ORM\Column(name="unit2_name", type="string", length=30, nullable=false)
     */
    private $unit2Name;

    /**
     * @var string
     *
     * @ORM\Column(name="unit3_name", type="string", length=30, nullable=false)
     */
    private $unit3Name;

    /**
     * @var string
     *
     * @ORM\Column(name="unit4_name", type="string", length=30, nullable=false)
     */
    private $unit4Name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dialing_code", type="string", length=5, nullable=true)
     */
    private $dialingCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    public function setContactPerson(?string $contactPerson): self
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }

    public function getContactPhone(): ?string
    {
        return $this->contactPhone;
    }

    public function setContactPhone(?string $contactPhone): self
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    public function getContactEmail(): ?string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(?string $contactEmail): self
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

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

    public function getUnit1Name(): ?string
    {
        return $this->unit1Name;
    }

    public function setUnit1Name(string $unit1Name): self
    {
        $this->unit1Name = $unit1Name;

        return $this;
    }

    public function getUnit2Name(): ?string
    {
        return $this->unit2Name;
    }

    public function setUnit2Name(string $unit2Name): self
    {
        $this->unit2Name = $unit2Name;

        return $this;
    }

    public function getUnit3Name(): ?string
    {
        return $this->unit3Name;
    }

    public function setUnit3Name(string $unit3Name): self
    {
        $this->unit3Name = $unit3Name;

        return $this;
    }

    public function getUnit4Name(): ?string
    {
        return $this->unit4Name;
    }

    public function setUnit4Name(string $unit4Name): self
    {
        $this->unit4Name = $unit4Name;

        return $this;
    }

    public function getDialingCode(): ?string
    {
        return $this->dialingCode;
    }

    public function setDialingCode(?string $dialingCode): self
    {
        $this->dialingCode = $dialingCode;

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


}
