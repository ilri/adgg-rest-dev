<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfNumberingFormat
 *
 * @ORM\Table(name="conf_numbering_format", indexes={@ORM\Index(name="code", columns={"code"}), @ORM\Index(name="org_id", columns={"country_id"})})
 * @ORM\Entity
 */
class ConfNumberingFormat
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
     * @ORM\Column(name="code", type="string", length=60, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="next_number", type="integer", nullable=false, options={"default"="1"})
     */
    private $nextNumber = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="min_digits", type="smallint", nullable=false, options={"default"="3"})
     */
    private $minDigits = '3';

    /**
     * @var string|null
     *
     * @ORM\Column(name="prefix", type="string", length=5, nullable=true)
     */
    private $prefix;

    /**
     * @var string|null
     *
     * @ORM\Column(name="suffix", type="string", length=5, nullable=true)
     */
    private $suffix;

    /**
     * @var string|null
     *
     * @ORM\Column(name="preview", type="string", length=128, nullable=true)
     */
    private $preview;

    /**
     * @var int|null
     *
     * @ORM\Column(name="country_id", type="integer", nullable=true)
     */
    private $countryId;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_private", type="boolean", nullable=false)
     */
    private $isPrivate = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isActive = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $createdBy;

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

    public function getNextNumber(): ?int
    {
        return $this->nextNumber;
    }

    public function setNextNumber(int $nextNumber): self
    {
        $this->nextNumber = $nextNumber;

        return $this;
    }

    public function getMinDigits(): ?int
    {
        return $this->minDigits;
    }

    public function setMinDigits(int $minDigits): self
    {
        $this->minDigits = $minDigits;

        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setPrefix(?string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getSuffix(): ?string
    {
        return $this->suffix;
    }

    public function setSuffix(?string $suffix): self
    {
        $this->suffix = $suffix;

        return $this;
    }

    public function getPreview(): ?string
    {
        return $this->preview;
    }

    public function setPreview(?string $preview): self
    {
        $this->preview = $preview;

        return $this;
    }

    public function getCountryId(): ?int
    {
        return $this->countryId;
    }

    public function setCountryId(?int $countryId): self
    {
        $this->countryId = $countryId;

        return $this;
    }

    public function getIsPrivate(): ?bool
    {
        return $this->isPrivate;
    }

    public function setIsPrivate(bool $isPrivate): self
    {
        $this->isPrivate = $isPrivate;

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


}
