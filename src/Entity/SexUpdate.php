<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SexUpdate
 *
 * @ORM\Table(name="sex_update")
 * @ORM\Entity
 */
class SexUpdate
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
     * @ORM\Column(name="animalid", type="string", length=145, nullable=true)
     */
    private $animalid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sex", type="string", length=45, nullable=true)
     */
    private $sex;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnimalid(): ?string
    {
        return $this->animalid;
    }

    public function setAnimalid(?string $animalid): self
    {
        $this->animalid = $animalid;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }


}
