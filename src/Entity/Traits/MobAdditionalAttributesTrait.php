<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait MobAdditionalAttributesTrait
{
    /**
     * @var array|null
     *
     * @ORM\Column(name="mob_additional_attributes", type="json", nullable=true)
     */
    private $mobAdditionalAttributes;


    public function getMobAdditionalAttributes(): ?array
    {
        return $this->mobAdditionalAttributes;
    }

    public function setMobAdditionalAttributes(?array $mobAdditionalAttributes): self
    {
        $this->mobAdditionalAttributes = $mobAdditionalAttributes;

        return $this;
    }
}
