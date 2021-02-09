<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * BirthdateUpdate
 *
 * @ApiResource()
 * @ORM\Table(name="birthdate_update")
 * @ORM\Entity
 */
class BirthdateUpdate
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="animalid", type="integer", nullable=true)
     */
    private $animalid;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="birthdate", type="date", nullable=true)
     */
    private $birthdate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnimalid(): ?int
    {
        return $this->animalid;
    }

    public function setAnimalid(?int $animalid): self
    {
        $this->animalid = $animalid;

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


}
