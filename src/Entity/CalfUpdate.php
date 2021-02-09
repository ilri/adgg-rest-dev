<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CalfUpdate
 *
 * @ORM\Table(name="calf_update")
 * @ORM\Entity
 */
class CalfUpdate
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
     * @var string|null
     *
     * @ORM\Column(name="animalid", type="string", length=145, nullable=true)
     */
    private $animalid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sex", type="string", length=45, nullable=true)
     */
    private $sex;


}
