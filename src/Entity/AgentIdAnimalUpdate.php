<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgentIdAnimalUpdate
 *
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


}
