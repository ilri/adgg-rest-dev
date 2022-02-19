<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreMasterCountry
 *
 * @ORM\Table(name="core_master_country", indexes={@ORM\Index(name="currency_id", columns={"currency"})})
 * @ORM\Entity
 */
class CoreMasterCountry
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
     * @ORM\Column(name="iso2", type="string", length=2, nullable=false)
     */
    private $iso2;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isActive = true;

    /**
     * @var string|null
     *
     * @ORM\Column(name="call_code", type="string", length=10, nullable=true)
     */
    private $callCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="currency", type="string", length=3, nullable=true)
     */
    private $currency;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIso2(): ?string
    {
        return $this->iso2;
    }

    public function setIso2(string $iso2): self
    {
        $this->iso2 = $iso2;

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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCallCode(): ?string
    {
        return $this->callCode;
    }

    public function setCallCode(?string $callCode): self
    {
        $this->callCode = $callCode;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }


}
