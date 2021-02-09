<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * RecordDelete
 *
 * @ApiResource()
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOdkcode(): ?string
    {
        return $this->odkcode;
    }

    public function setOdkcode(?string $odkcode): self
    {
        $this->odkcode = $odkcode;

        return $this;
    }


}
