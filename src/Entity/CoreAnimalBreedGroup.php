<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreAnimalBreedGroup
 *
 * @ORM\Table(name="core_animal_breed_group")
 * @ORM\Entity
 */
class CoreAnimalBreedGroup
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var json
     *
     * @ORM\Column(name="breeds", type="json", nullable=false)
     */
    private $breeds;

    /**
     * @var string|null
     *
     * @ORM\Column(name="color", type="string", length=128, nullable=true)
     */
    private $color;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isActive = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;


}
