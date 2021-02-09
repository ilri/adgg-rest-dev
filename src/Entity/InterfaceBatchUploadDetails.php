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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(?string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getMilkDate(): ?string
    {
        return $this->milkDate;
    }

    public function setMilkDate(?string $milkDate): self
    {
        $this->milkDate = $milkDate;

        return $this;
    }

    public function getAnimalId(): ?string
    {
        return $this->animalId;
    }

    public function setAnimalId(?string $animalId): self
    {
        $this->animalId = $animalId;

        return $this;
    }

    public function getAmountMorning(): ?string
    {
        return $this->amountMorning;
    }

    public function setAmountMorning(?string $amountMorning): self
    {
        $this->amountMorning = $amountMorning;

        return $this;
    }

    public function getAmountNoon(): ?string
    {
        return $this->amountNoon;
    }

    public function setAmountNoon(?string $amountNoon): self
    {
        $this->amountNoon = $amountNoon;

        return $this;
    }

    public function getAmountAfternoon(): ?string
    {
        return $this->amountAfternoon;
    }

    public function setAmountAfternoon(?string $amountAfternoon): self
    {
        $this->amountAfternoon = $amountAfternoon;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getLactationId(): ?int
    {
        return $this->lactationId;
    }

    public function setLactationId(?int $lactationId): self
    {
        $this->lactationId = $lactationId;

        return $this;
    }

    public function getLactationNumber(): ?int
    {
        return $this->lactationNumber;
    }

    public function setLactationNumber(?int $lactationNumber): self
    {
        $this->lactationNumber = $lactationNumber;

        return $this;
    }

    public function getDaysInMilk(): ?int
    {
        return $this->daysInMilk;
    }

    public function setDaysInMilk(?int $daysInMilk): self
    {
        $this->daysInMilk = $daysInMilk;

        return $this;
    }

    public function getTestDayNo(): ?int
    {
        return $this->testDayNo;
    }

    public function setTestDayNo(?int $testDayNo): self
    {
        $this->testDayNo = $testDayNo;

        return $this;
    }


}
