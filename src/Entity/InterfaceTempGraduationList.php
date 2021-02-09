<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceTempGraduationList
 *
 * @ORM\Table(name="interface_temp_graduation_list")
 * @ORM\Entity
 */
class InterfaceTempGraduationList
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
     * @var int|null
     *
     * @ORM\Column(name="animal_id", type="integer", nullable=true)
     */
    private $animalId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="animal_type", type="integer", nullable=true)
     */
    private $animalType;

    /**
     * @var int|null
     *
     * @ORM\Column(name="age_months", type="integer", nullable=true)
     */
    private $ageMonths;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="birthdate", type="datetime", nullable=true)
     */
    private $birthdate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="graduate_from", type="integer", nullable=true)
     */
    private $graduateFrom;

    /**
     * @var int|null
     *
     * @ORM\Column(name="graduate_to", type="integer", nullable=true)
     */
    private $graduateTo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="graduation_process_id", type="integer", nullable=true)
     */
    private $graduationProcessId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="uuid", type="string", length=250, nullable=true)
     */
    private $uuid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnimalId(): ?int
    {
        return $this->animalId;
    }

    public function setAnimalId(?int $animalId): self
    {
        $this->animalId = $animalId;

        return $this;
    }

    public function getAnimalType(): ?int
    {
        return $this->animalType;
    }

    public function setAnimalType(?int $animalType): self
    {
        $this->animalType = $animalType;

        return $this;
    }

    public function getAgeMonths(): ?int
    {
        return $this->ageMonths;
    }

    public function setAgeMonths(?int $ageMonths): self
    {
        $this->ageMonths = $ageMonths;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getGraduateFrom(): ?int
    {
        return $this->graduateFrom;
    }

    public function setGraduateFrom(?int $graduateFrom): self
    {
        $this->graduateFrom = $graduateFrom;

        return $this;
    }

    public function getGraduateTo(): ?int
    {
        return $this->graduateTo;
    }

    public function setGraduateTo(?int $graduateTo): self
    {
        $this->graduateTo = $graduateTo;

        return $this;
    }

    public function getGraduationProcessId(): ?int
    {
        return $this->graduationProcessId;
    }

    public function setGraduationProcessId(?int $graduationProcessId): self
    {
        $this->graduationProcessId = $graduationProcessId;

        return $this;
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


}
