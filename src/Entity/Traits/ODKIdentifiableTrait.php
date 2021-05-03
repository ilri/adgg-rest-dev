<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait ODKIdentifiableTrait
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="odk_form_uuid", type="string", length=128, nullable=true)
     */
    protected $odkFormUuid;

    public function getOdkFormUuid(): ?string
    {
        return $this->odkFormUuid;
    }

    public function setOdkFormUuid(?string $odkFormUuid): self
    {
        $this->odkFormUuid = $odkFormUuid;

        return $this;
    }
}
