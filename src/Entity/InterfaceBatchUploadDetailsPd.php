<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceBatchUploadDetailsPd
 *
 * @ORM\Table(name="interface_batch_upload_details_pd")
 * @ORM\Entity
 */
class InterfaceBatchUploadDetailsPd
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
     * @ORM\Column(name="animal_id", type="string", length=250, nullable=true)
     */
    private $animalId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="exam_date", type="string", length=250, nullable=true)
     */
    private $examDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pd_method", type="string", length=250, nullable=true)
     */
    private $pdMethod;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pd_results", type="string", length=250, nullable=true)
     */
    private $pdResults;

    /**
     * @var string|null
     *
     * @ORM\Column(name="stage", type="string", length=250, nullable=true)
     */
    private $stage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="body_condition", type="string", length=250, nullable=true)
     */
    private $bodyCondition;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pd_cost", type="string", length=250, nullable=true)
     */
    private $pdCost;

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

    public function getAnimalId(): ?string
    {
        return $this->animalId;
    }

    public function setAnimalId(?string $animalId): self
    {
        $this->animalId = $animalId;

        return $this;
    }

    public function getExamDate(): ?string
    {
        return $this->examDate;
    }

    public function setExamDate(?string $examDate): self
    {
        $this->examDate = $examDate;

        return $this;
    }

    public function getPdMethod(): ?string
    {
        return $this->pdMethod;
    }

    public function setPdMethod(?string $pdMethod): self
    {
        $this->pdMethod = $pdMethod;

        return $this;
    }

    public function getPdResults(): ?string
    {
        return $this->pdResults;
    }

    public function setPdResults(?string $pdResults): self
    {
        $this->pdResults = $pdResults;

        return $this;
    }

    public function getStage(): ?string
    {
        return $this->stage;
    }

    public function setStage(?string $stage): self
    {
        $this->stage = $stage;

        return $this;
    }

    public function getBodyCondition(): ?string
    {
        return $this->bodyCondition;
    }

    public function setBodyCondition(?string $bodyCondition): self
    {
        $this->bodyCondition = $bodyCondition;

        return $this;
    }

    public function getPdCost(): ?string
    {
        return $this->pdCost;
    }

    public function setPdCost(?string $pdCost): self
    {
        $this->pdCost = $pdCost;

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


}
