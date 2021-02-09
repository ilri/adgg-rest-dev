<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgentIdUpdateFarmers
 *
 * @ORM\Table(name="agent_id_update_farmers")
 * @ORM\Entity
 */
class AgentIdUpdateFarmers
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
     * @ORM\Column(name="farmername_farmermobile", type="string", length=145, nullable=true)
     */
    private $farmernameFarmermobile;

    /**
     * @var int|null
     *
     * @ORM\Column(name="agent_id", type="integer", nullable=true)
     */
    private $agentId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFarmernameFarmermobile(): ?string
    {
        return $this->farmernameFarmermobile;
    }

    public function setFarmernameFarmermobile(?string $farmernameFarmermobile): self
    {
        $this->farmernameFarmermobile = $farmernameFarmermobile;

        return $this;
    }

    public function getAgentId(): ?int
    {
        return $this->agentId;
    }

    public function setAgentId(?int $agentId): self
    {
        $this->agentId = $agentId;

        return $this;
    }


}
