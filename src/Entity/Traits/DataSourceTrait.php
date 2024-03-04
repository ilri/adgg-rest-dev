<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait DataSourceTrait
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="source_id", type="integer", nullable=true)
     */
    private $sourceId;

    public function getSourceId(): int
    {
        return $this->sourceId ?? 0;
    }

    public function setSourceId(?int $sourceId): void
    {
        $this->sourceId = $sourceId;
    }
}
