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


}
