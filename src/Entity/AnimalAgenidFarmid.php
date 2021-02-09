<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnimalAgenidFarmid
 *
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


}
