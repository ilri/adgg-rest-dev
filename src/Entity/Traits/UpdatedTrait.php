<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait UpdatedTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @ORM\Version
     */
    protected $updatedAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=true)})
     */
    protected $updatedBy;

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?int $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }
}
