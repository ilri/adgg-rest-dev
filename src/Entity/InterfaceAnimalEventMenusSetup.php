<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceAnimalEventMenusSetup
 *
 * @ORM\Table(name="interface_animal_event_menus_setup")
 * @ORM\Entity
 */
class InterfaceAnimalEventMenusSetup
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
     * @ORM\Column(name="animal_type", type="integer", nullable=true)
     */
    private $animalType;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="calving", type="boolean", nullable=true)
     */
    private $calving = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="milking", type="boolean", nullable=true)
     */
    private $milking = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="health", type="boolean", nullable=true)
     */
    private $health = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="bio_data", type="boolean", nullable=true)
     */
    private $bioData = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="insemination", type="boolean", nullable=true)
     */
    private $insemination = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sync", type="boolean", nullable=true)
     */
    private $sync = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="exit", type="boolean", nullable=true)
     */
    private $exit = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="weight", type="boolean", nullable=true)
     */
    private $weight = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="pd", type="boolean", nullable=true)
     */
    private $pd = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=true)
     */
    private $updatedBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


}
