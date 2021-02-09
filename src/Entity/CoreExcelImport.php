<?php

/**
 * @ApiResource()


use Doctrine\ORM\Mapping as ORM;

/**
 * CoreExcelImport
 *
 * @ApiResource()
 * @ORM\Table(name="core_excel_import", indexes={@ORM\Index(name="org_id", columns={"country_id"})})
 * @ORM\Entity
 */
class CoreExcelImport
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
     * @ORM\Column(name="uuid", type="string", length=255, nullable=false)
     */
    private $uuid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="country_id", type="integer", nullable=true)
     */
    private $countryId;

    /**
     * @var bool
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type;

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
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=255, nullable=false)
     */
    private $fileName;

    /**
     * @var bool
     *
     * @ORM\Column(name="has_errors", type="boolean", nullable=false)
     */
    private $hasErrors = '0';

    /**
     * @var json|null
     *
     * @ORM\Column(name="error_message", type="json", nullable=true)
     */
    private $errorMessage;

    /**
     * @var json|null
     *
     * @ORM\Column(name="success_message", type="json", nullable=true)
     */
    private $successMessage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="processing_duration_seconds", type="decimal", precision=13, scale=4, nullable=true)
     */
    private $processingDurationSeconds;

    /**
     * @var int|null
     *
     * @ORM\Column(name="current_processed_row", type="integer", nullable=true)
     */
    private $currentProcessedRow;

    /**
     * @var string|null
     *
     * @ORM\Column(name="error_csv", type="string", length=255, nullable=true)
     */
    private $errorCsv;

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

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

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

    public function getType(): ?bool
    {
        return $this->type;
    }

    public function setType(bool $type): self
    {
        $this->type = $type;

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

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

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

    public function getErrorMessage(): ?array
    {
        return $this->errorMessage;
    }

    public function setErrorMessage(?array $errorMessage): self
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    public function getSuccessMessage(): ?array
    {
        return $this->successMessage;
    }

    public function setSuccessMessage(?array $successMessage): self
    {
        $this->successMessage = $successMessage;

        return $this;
    }

    public function getProcessingDurationSeconds(): ?string
    {
        return $this->processingDurationSeconds;
    }

    public function setProcessingDurationSeconds(?string $processingDurationSeconds): self
    {
        $this->processingDurationSeconds = $processingDurationSeconds;

        return $this;
    }

    public function getCurrentProcessedRow(): ?int
    {
        return $this->currentProcessedRow;
    }

    public function setCurrentProcessedRow(?int $currentProcessedRow): self
    {
        $this->currentProcessedRow = $currentProcessedRow;

        return $this;
    }

    public function getErrorCsv(): ?string
    {
        return $this->errorCsv;
    }

    public function setErrorCsv(?string $errorCsv): self
    {
        $this->errorCsv = $errorCsv;

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
