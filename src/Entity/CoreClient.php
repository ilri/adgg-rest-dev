<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreClient
 *
 * @ORM\Table(name="core_client", indexes={@ORM\Index(name="country_id", columns={"country_id"})})
 * @ORM\Entity
 */
class CoreClient
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment"="Unique id which is auto-generated"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false, options={"comment"="Name of the client e.g ADC"})
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true, options={"comment"="Description of the client"})
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="org_id", type="integer", nullable=true, options={"comment"="The organization of the client"})
     */
    private $orgId;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1","comment"="Whether the record is active"})
     */
    private $isActive = true;

    /**
     * @var json|null
     *
     * @ORM\Column(name="additional_attributes", type="json", nullable=true)
     */
    private $additionalAttributes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP","comment"="The date the record was created"})
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true, options={"comment"="Id of the user who created the records"})
     */
    private $createdBy;

    /**
     * @var string|null
     *
     * @ORM\Column(name="migration_id", type="string", length=255, nullable=true, options={"comment"="This is the migrationSouce plus primary key from migration source table of the record e.g KLBA_001"})
     */
    private $migrationId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="odk_form_uuid", type="string", length=128, nullable=true)
     */
    private $odkFormUuid;

    /**
     * @var \CoreCountry
     *
     * @ORM\ManyToOne(targetEntity="CoreCountry")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    private $country;


}
