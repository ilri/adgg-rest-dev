<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * AgentIdAnimalUpdate
 *
 * @ApiResource()
 * @ORM\Table(name="agent_id_animal_update")
 * @ORM\Entity
 */
class AgentIdAnimalUpdate
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
     * @ORM\Column(name="animaid", type="string", length=145, nullable=true)
     */
    private $animaid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="agent_id_animal", type="string", length=45, nullable=true)
     */
    private $agentIdAnimal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnimaid(): ?string
    {
        return $this->animaid;
    }

    public function setAnimaid(?string $animaid): self
    {
        $this->animaid = $animaid;

        return $this;
    }

    public function getAgentIdAnimal(): ?string
    {
        return $this->agentIdAnimal;
    }

    public function setAgentIdAnimal(?string $agentIdAnimal): self
    {
        $this->agentIdAnimal = $agentIdAnimal;

        return $this;
    }


}
