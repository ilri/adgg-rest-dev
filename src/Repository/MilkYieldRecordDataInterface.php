<?php

namespace App\Repository;

use App\Entity\MilkYieldRecord;

interface MilkYieldRecordDataInterface
{
    /**
     * @param int $page
     * @return array<int, MilkYieldRecord>
     */
    public function getMilkYieldRecords(int $page = 1): array;

    /**
     * @param int $eventId
     * @return MilkYieldRecord
     */
    public function getMilkYieldRecord(int $eventId): MilkYieldRecord;
}