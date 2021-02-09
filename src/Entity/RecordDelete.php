<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecordDelete
 *
 * @ORM\Table(name="record_delete")
 * @ORM\Entity
 */
class RecordDelete
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
     * @ORM\Column(name="OdkCode", type="string", length=145, nullable=true)
     */
    private $odkcode;


}
