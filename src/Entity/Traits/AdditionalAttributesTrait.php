<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait AdditionalAttributesTrait
{
    /**
     * @var array|null
     *
     * @ORM\Column(name="additional_attributes", type="json", nullable=true)
     */
    protected $additionalAttributes;


    public function getAdditionalAttributes(): ?array
    {
        return $this->additionalAttributes;
    }

    public function setAdditionalAttributes(?array $additionalAttributes): self
    {
        $this->additionalAttributes = $additionalAttributes;

        return $this;
    }
}
