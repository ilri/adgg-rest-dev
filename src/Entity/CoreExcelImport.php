<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreExcelImport
 *
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


}
