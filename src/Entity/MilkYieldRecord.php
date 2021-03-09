<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\{
    ApiProperty,
    ApiResource
};

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get"={
 *             "method"="GET",
 *             "normalization_context"={
 *                 "groups"={
 *                      "milkyieldrecord:collection:get"
 *                 }
 *             }
 *         }
 *     },
 *     itemOperations={
 *         "get"={
 *             "method"="GET",
 *             "normalization_context"={
 *                 "groups"={
 *                      "milkyieldrecord:item:get"
 *                 }
 *             }
 *         }
 *     }
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
     * @var AnimalEvent
     */
    private $animalEvent;

    /**
     * @var Animal
     */
    private $animal;

    /**
     * @var Farm
     */
    private $farm;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getAnimalEvent(): ?AnimalEvent
    {
        return $this->animalEvent;
    }

    public function setAnimalEvent(AnimalEvent $animalEvent): self
    {
        $this->animalEvent = $animalEvent;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(Animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }

    public function getFarm(): ?Farm
    {
        return $this->farm;
    }

    public function setFarm(Farm $farm): self
    {
        $this->farm = $farm;

        return $this;
    }

    public function getLactationId(): ?int
    {
        return $this->lactationId;
    }

    public function setLactationId(int $lactationId): self
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
