<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreOdkForm
 *
 * @ORM\Table(name="core_odk_form", indexes={@ORM\Index(name="org_id", columns={"country_id"})})
 * @ORM\Entity
 */
class CoreOdkForm
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
     * @var string
     *
     * @ORM\Column(name="form_uuid", type="string", length=128, nullable=false)
     */
    private $formUuid;

    /**
     * @var json
     *
     * @ORM\Column(name="form_data", type="json", nullable=false)
     */
    private $formData;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_processed", type="boolean", nullable=false)
     */
    private $isProcessed = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="processed_at", type="datetime", nullable=true)
     */
    private $processedAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="country_id", type="integer", nullable=true)
     */
    private $countryId;

    /**
     * @var bool
     *
     * @ORM\Column(name="has_errors", type="boolean", nullable=false)
     */
    private $hasErrors = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="error_message", type="text", length=65535, nullable=true)
     */
    private $errorMessage;

    /**
     * @var json|null
     *
     * @ORM\Column(name="farm_data", type="json", nullable=true)
     */
    private $farmData;

    /**
     * @var json|null
     *
     * @ORM\Column(name="farm_metadata", type="json", nullable=true)
     */
    private $farmMetadata;

    /**
     * @var json|null
     *
     * @ORM\Column(name="animals_data", type="json", nullable=true)
     */
    private $animalsData;

    /**
     * @var json|null
     *
     * @ORM\Column(name="animal_events_data", type="json", nullable=true)
     */
    private $animalEventsData;

    /**
     * @var json|null
     *
     * @ORM\Column(name="user_data", type="json", nullable=true)
     */
    private $userData;

    /**
     * @var string|null
     *
     * @ORM\Column(name="form_version", type="string", length=30, nullable=true)
     */
    private $formVersion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true, options={"comment"="data collection user/staff id"})
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormUuid(): ?string
    {
        return $this->formUuid;
    }

    public function setFormUuid(string $formUuid): self
    {
        $this->formUuid = $formUuid;

        return $this;
    }

    public function getFormData(): ?array
    {
        return $this->formData;
    }

    public function setFormData(array $formData): self
    {
        $this->formData = $formData;

        return $this;
    }

    public function getIsProcessed(): ?bool
    {
        return $this->isProcessed;
    }

    public function setIsProcessed(bool $isProcessed): self
    {
        $this->isProcessed = $isProcessed;

        return $this;
    }

    public function getProcessedAt(): ?\DateTimeInterface
    {
        return $this->processedAt;
    }

    public function setProcessedAt(?\DateTimeInterface $processedAt): self
    {
        $this->processedAt = $processedAt;

        return $this;
    }

    public function getCountryId(): ?int
    {
        return $this->countryId;
    }

    public function setCountryId(?int $countryId): self
    {
        $this->countryId = $countryId;

        return $this;
    }

    public function getHasErrors(): ?bool
    {
        return $this->hasErrors;
    }

    public function setHasErrors(bool $hasErrors): self
    {
        $this->hasErrors = $hasErrors;

        return $this;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    public function setErrorMessage(?string $errorMessage): self
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    public function getFarmData(): ?array
    {
        return $this->farmData;
    }

    public function setFarmData(?array $farmData): self
    {
        $this->farmData = $farmData;

        return $this;
    }

    public function getFarmMetadata(): ?array
    {
        return $this->farmMetadata;
    }

    public function setFarmMetadata(?array $farmMetadata): self
    {
        $this->farmMetadata = $farmMetadata;

        return $this;
    }

    public function getAnimalsData(): ?array
    {
        return $this->animalsData;
    }

    public function setAnimalsData(?array $animalsData): self
    {
        $this->animalsData = $animalsData;

        return $this;
    }

    public function getAnimalEventsData(): ?array
    {
        return $this->animalEventsData;
    }

    public function setAnimalEventsData(?array $animalEventsData): self
    {
        $this->animalEventsData = $animalEventsData;

        return $this;
    }

    public function getUserData(): ?array
    {
        return $this->userData;
    }

    public function setUserData(?array $userData): self
    {
        $this->userData = $userData;

        return $this;
    }

    public function getFormVersion(): ?string
    {
        return $this->formVersion;
    }

    public function setFormVersion(?string $formVersion): self
    {
        $this->formVersion = $formVersion;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?int $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }


}
