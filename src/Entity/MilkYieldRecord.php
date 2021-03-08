<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\{
    ApiProperty,
    ApiResource
};

/**
 * @ApiResource(
 *     attributes={
 *         "pagination_enabled"=true,
 *         "pagination_items_per_page"=10
 *     },
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class MilkYieldRecord
{
    /**
     * @var int
     *
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @var int
     */
    private $animalId;

    /**
     * @var int
     */
    private $farmId;

    /**
     * @var int
     */
    private $lactationId;

    /**
     * @var int
     */
    private $daysInMilk;

    /**
     * @var float
     */
    private $totalMilkRecord;

    /**
     * @var float
     */
    private $expectedMilkYield;

    /**
     * @var float
     */
    private $upperLimit;

    /**
     * @var float
     */
    private $lowerLimit;

    /**
     * @var string
     */
    private $feedback;

    /**
     * @var \DateTime
     */
    private $calvingDate;

    /**
     * @var \DateTime
     */
    private $milkingDate;

    public function __construct(
        int $id,
        int $animalId,
        int $farmId,
        int $lactationId,
        int $daysInMilk,
        float $totalMilkRecord,
        float $expectedMilkYield,
        float $upperLimit,
        float $lowerLimit,
        string $feedback,
        \DateTimeInterface $calvingDate,
        \DateTimeInterface $milkingDate
    )
    {
        $this->id = $id;
        $this->animalId = $animalId;
        $this->farmId = $farmId;
        $this->lactationId = $lactationId;
        $this->daysInMilk = $daysInMilk;
        $this->totalMilkRecord = $totalMilkRecord;
        $this->expectedMilkYield = $expectedMilkYield;
        $this->upperLimit = $upperLimit;
        $this->lowerLimit = $lowerLimit;
        $this->feedback = $feedback;
        $this->calvingDate = $calvingDate;
        $this->milkingDate = $milkingDate;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getAnimalId(): ?int
    {
        return $this->animalId;
    }

    public function setAnimalId(int $animalId): self
    {
        $this->animalId = $animalId;

        return $this;
    }

    public function getFarmId(): ?int
    {
        return $this->farmId;
    }

    public function setFarmId(int $farmId): self
    {
        $this->farmId = $farmId;

        return $this;
    }

    public function getLactationId(): ?int
    {
        return $this->lactationId;
    }

    public function setLactationIdd(int $lactationId): self
    {
        $this->lactationId = $lactationId;

        return $this;
    }

    public function getDaysInMilk(): ?int
    {
        return $this->daysInMilk;
    }

    public function setDaysInMilk(int $daysInMilk): self
    {
        $this->daysInMilk = $daysInMilk;

        return $this;
    }

    public function getTotalMilkRecord(): ?float
    {
        return $this->totalMilkRecord;
    }

    public function setTotalMilkRecord(float $totalMilkRecord): self
    {
        $this->totalMilkRecord = $totalMilkRecord;

        return $this;
    }

    public function getExpectedMilkYield(): ?float
    {
        return $this->expectedMilkYield;
    }

    public function setExpectedMilkYield(float $expectedMilkYield): self
    {
        $this->expectedMilkYield = $expectedMilkYield;

        return $this;
    }

    public function getUpperLimit(): ?float
    {
        return $this->upperLimit;
    }

    public function setUpperLimit(float $upperLimit): self
    {
        $this->upperLimit = $upperLimit;

        return $this;
    }

    public function getLowerLimit(): ?float
    {
        return $this->lowerLimit;
    }

    public function setLowerLimit(float $lowerLimit): self
    {
        $this->lowerLimit = $lowerLimit;

        return $this;
    }

    public function getFeedback(): ?string
    {
        return $this->feedback;
    }

    public function setFeedback(string $feedback): self
    {
        $this->feedback = $feedback;

        return $this;
    }

    public function getCalvingDate(): ?\DateTimeInterface
    {
        return $this->calvingDate;
    }

    public function setCalvingDate(\DateTimeInterface $calvingDate): self
    {
        $this->calvingDate = $calvingDate;

        return $this;
    }

    public function getMilkingDate(): ?\DateTimeInterface
    {
        return $this->milkingDate;
    }

    public function setMilkingDate(\DateTimeInterface $milkingDate): self
    {
        $this->milkingDate = $milkingDate;

        return $this;
    }
}
