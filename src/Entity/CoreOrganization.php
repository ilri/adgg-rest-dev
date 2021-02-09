<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreOrganization
 *
 * @ORM\Table(name="core_organization", indexes={@ORM\Index(name="country_id", columns={"country_id"})})
 * @ORM\Entity
 */
class CoreOrganization
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false, options={"comment"="Name of the organization e.g KLBA"})
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1","comment"="Whether the organization is active"})
     */
    private $isActive = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP","comment"="Date the record was created"})
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true, options={"comment"="Id of the user who created the record"})
     */
    private $createdBy;

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
