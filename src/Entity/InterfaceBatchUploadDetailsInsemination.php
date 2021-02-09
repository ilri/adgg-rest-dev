<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceBatchUploadDetailsInsemination
 *
 * @ApiResource()
 * @ORM\Table(name="interface_batch_upload_details_insemination")
 * @ORM\Entity
 */
class InterfaceBatchUploadDetailsInsemination
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
     * @ORM\Column(name="service_date", type="string", length=250, nullable=true)
     */
    private $serviceDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ai_type", type="string", length=250, nullable=true)
     */
    private $aiType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="straw_id", type="string", length=250, nullable=true)
     */
    private $strawId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="body_score", type="string", length=250, nullable=true)
     */
    private $bodyScore;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cost", type="string", length=250, nullable=true)
     */
    private $cost;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ai_tech", type="string", length=250, nullable=true)
     */
    private $aiTech;

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

    public function getServiceDate(): ?string
    {
        return $this->serviceDate;
    }

    public function setServiceDate(?string $serviceDate): self
    {
        $this->serviceDate = $serviceDate;

        return $this;
    }

    public function getAiType(): ?string
    {
        return $this->aiType;
    }

    public function setAiType(?string $aiType): self
    {
        $this->aiType = $aiType;

        return $this;
    }

    public function getStrawId(): ?string
    {
        return $this->strawId;
    }

    public function setStrawId(?string $strawId): self
    {
        $this->strawId = $strawId;

        return $this;
    }

    public function getBodyScore(): ?string
    {
        return $this->bodyScore;
    }

    public function setBodyScore(?string $bodyScore): self
    {
        $this->bodyScore = $bodyScore;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(?string $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getAiTech(): ?string
    {
        return $this->aiTech;
    }

    public function setAiTech(?string $aiTech): self
    {
        $this->aiTech = $aiTech;

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
