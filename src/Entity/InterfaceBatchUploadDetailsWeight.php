<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceBatchUploadDetailsWeight
 *
 * @ORM\Table(name="interface_batch_upload_details_weight")
 * @ORM\Entity
 */
class InterfaceBatchUploadDetailsWeight
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
     * @ORM\Column(name="weight_date", type="string", length=250, nullable=true)
     */
    private $weightDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="body_length", type="string", length=250, nullable=true)
     */
    private $bodyLength;

    /**
     * @var string|null
     *
     * @ORM\Column(name="heart_girth", type="string", length=250, nullable=true)
     */
    private $heartGirth;

    /**
     * @var string|null
     *
     * @ORM\Column(name="body_weight", type="string", length=250, nullable=true)
     */
    private $bodyWeight;

    /**
     * @var string|null
     *
     * @ORM\Column(name="body_score", type="string", length=250, nullable=true)
     */
    private $bodyScore;

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

    public function getWeightDate(): ?string
    {
        return $this->weightDate;
    }

    public function setWeightDate(?string $weightDate): self
    {
        $this->weightDate = $weightDate;

        return $this;
    }

    public function getBodyLength(): ?string
    {
        return $this->bodyLength;
    }

    public function setBodyLength(?string $bodyLength): self
    {
        $this->bodyLength = $bodyLength;

        return $this;
    }

    public function getHeartGirth(): ?string
    {
        return $this->heartGirth;
    }

    public function setHeartGirth(?string $heartGirth): self
    {
        $this->heartGirth = $heartGirth;

        return $this;
    }

    public function getBodyWeight(): ?string
    {
        return $this->bodyWeight;
    }

    public function setBodyWeight(?string $bodyWeight): self
    {
        $this->bodyWeight = $bodyWeight;

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
