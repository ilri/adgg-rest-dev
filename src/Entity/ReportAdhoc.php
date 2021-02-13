<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * ReportAdhoc
 *
 * @ORM\Table(name="report_adhoc")
 * @ORM\Entity
 */
class ReportAdhoc
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
     * @var int|null
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_standard", type="boolean", nullable=false)
     */
    private $isStandard = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="country_id", type="integer", nullable=true)
     */
    private $countryId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="raw_sql", type="text", length=65535, nullable=false)
     */
    private $rawSql;

    /**
     * @var string|null
     *
     * @ORM\Column(name="report_file", type="string", length=255, nullable=true)
     */
    private $reportFile;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status_remarks", type="string", length=1000, nullable=true)
     */
    private $statusRemarks;

    /**
     * @var string|null
     *
     * @ORM\Column(name="error_message", type="string", length=1000, nullable=true)
     */
    private $errorMessage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="error_trace", type="text", length=65535, nullable=true)
     */
    private $errorTrace;

    /**
     * @var array|null
     *
     * @ORM\Column(name="options", type="json", nullable=true)
     */
    private $options;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=true)
     */
    private $updatedBy;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_deleted", type="boolean", nullable=false)
     */
    private $isDeleted = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="deleted_by", type="integer", nullable=true)
     */
    private $deletedBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getIsStandard(): ?bool
    {
        return $this->isStandard;
    }

    public function setIsStandard(bool $isStandard): self
    {
        $this->isStandard = $isStandard;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRawSql(): ?string
    {
        return $this->rawSql;
    }

    public function setRawSql(string $rawSql): self
    {
        $this->rawSql = $rawSql;

        return $this;
    }

    public function getReportFile(): ?string
    {
        return $this->reportFile;
    }

    public function setReportFile(?string $reportFile): self
    {
        $this->reportFile = $reportFile;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatusRemarks(): ?string
    {
        return $this->statusRemarks;
    }

    public function setStatusRemarks(?string $statusRemarks): self
    {
        $this->statusRemarks = $statusRemarks;

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

    public function getErrorTrace(): ?string
    {
        return $this->errorTrace;
    }

    public function setErrorTrace(?string $errorTrace): self
    {
        $this->errorTrace = $errorTrace;

        return $this;
    }

    public function getOptions(): ?array
    {
        return $this->options;
    }

    public function setOptions(?array $options): self
    {
        $this->options = $options;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?int $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getDeletedBy(): ?int
    {
        return $this->deletedBy;
    }

    public function setDeletedBy(?int $deletedBy): self
    {
        $this->deletedBy = $deletedBy;

        return $this;
    }


}
