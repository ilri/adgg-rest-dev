<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BirthdateUpdate
 *
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


}
