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


}
