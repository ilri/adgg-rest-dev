<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceBatchUploadDetails
 *
 * @ORM\Table(name="interface_batch_upload_details")
 * @ORM\Entity
 */
class InterfaceBatchUploadDetails
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
     * @ORM\Column(name="uuid", type="string", length=250, nullable=true)
     */
    private $uuid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="milk_date", type="string", length=250, nullable=true)
     */
    private $milkDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="animal_id", type="string", length=250, nullable=true)
     */
    private $animalId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="amount_morning", type="string", length=250, nullable=true)
     */
    private $amountMorning;

    /**
     * @var string|null
     *
     * @ORM\Column(name="amount_noon", type="string", length=250, nullable=true)
     */
    private $amountNoon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="amount_afternoon", type="string", length=250, nullable=true)
     */
    private $amountAfternoon;

    /**
     * @var int|null
     *
     * @ORM\Column(name="status", type="integer", nullable=true, options={"default"="1"})
     */
    private $status = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="notes", type="string", length=250, nullable=true)
     */
    private $notes;

    /**
     * @var int|null
     *
     * @ORM\Column(name="lactation_id", type="integer", nullable=true)
     */
    private $lactationId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="lactation_number", type="integer", nullable=true)
     */
    private $lactationNumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="days_in_milk", type="integer", nullable=true)
     */
    private $daysInMilk;

    /**
     * @var int|null
     *
     * @ORM\Column(name="test_day_no", type="integer", nullable=true)
     */
    private $testDayNo;


}
