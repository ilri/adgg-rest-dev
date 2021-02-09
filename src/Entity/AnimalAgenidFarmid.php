<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * AnimalAgenidFarmid
 *
 * @ApiResource()
 * @ORM\Table(name="animal_agenid_farmid")
 * @ORM\Entity
 */
class AnimalAgenidFarmid
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
     * @ORM\Column(name="farmid", type="string", length=45, nullable=true)
     */
    private $farmid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="animalid", type="string", length=45, nullable=true)
     */
    private $animalid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="agentid", type="string", length=45, nullable=true)
     */
    private $agentid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFarmid(): ?string
    {
        return $this->farmid;
    }

    public function setFarmid(?string $farmid): self
    {
        $this->farmid = $farmid;

        return $this;
    }

    public function getAnimalid(): ?string
    {
        return $this->animalid;
    }

    public function setAnimalid(?string $animalid): self
    {
        $this->animalid = $animalid;

        return $this;
    }

    public function getAgentid(): ?string
    {
        return $this->agentid;
    }

    public function setAgentid(?string $agentid): self
    {
        $this->agentid = $agentid;

        return $this;
    }


}
