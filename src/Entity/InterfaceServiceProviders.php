<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceServiceProviders
 *
 * @ORM\Table(name="interface_service_providers")
 * @ORM\Entity
 */
class InterfaceServiceProviders
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="acronym", type="string", length=255, nullable=true)
     */
    private $acronym;

    /**
     * @var int|null
     *
     * @ORM\Column(name="service_provider_type", type="integer", nullable=true)
     */
    private $serviceProviderType;

    /**
     * @var int|null
     *
     * @ORM\Column(name="country", type="integer", nullable=true)
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postal_address", type="string", length=255, nullable=true)
     */
    private $postalAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postal_code", type="string", length=255, nullable=true)
     */
    private $postalCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="services_offered", type="string", length=255, nullable=true)
     */
    private $servicesOffered;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_person", type="string", length=255, nullable=true)
     */
    private $contactPerson;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_person_mobile_number", type="string", length=255, nullable=true)
     */
    private $contactPersonMobileNumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="org_id", type="integer", nullable=true)
     */
    private $orgId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="farm_id", type="integer", nullable=true)
     */
    private $farmId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=true)
     */
    private $updatedBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


}
