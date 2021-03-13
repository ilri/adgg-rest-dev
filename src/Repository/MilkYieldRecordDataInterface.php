<?php

namespace App\Repository;

use App\Entity\MilkYieldRecord;

interface MilkYieldRecordDataInterface
{
   /**
     * @param int $eventId
     * @return MilkYieldRecord
     */
    public function getMilkYieldRecord(int $eventId): MilkYieldRecord;
}