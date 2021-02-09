<?php

namespace App\Entity;

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
     * @var json|null
     *
     * @ORM\Column(name="options", type="json", nullable=true)
     */
    private $options;

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


}
