<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait DataSourceTrait
{

    /**
     * @var int | null
     *
     * @ORM\Column(name="source_id", type="integer", nullable=false)
     */
    private $sourceId;

    public function getSourceId(): int
    {
        return $this->sourceId;
    }

    public function setSourceId(int $sourceId): void
    {
        $this->sourceId = $sourceId;
    }



}