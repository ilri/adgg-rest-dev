<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfTimezoneRef
 *
 * @ORM\Table(name="conf_timezone_ref")
 * @ORM\Entity
 */
class ConfTimezoneRef
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;


}
