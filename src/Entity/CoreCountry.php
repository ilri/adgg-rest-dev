<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreCountry
 *
 * @ORM\Table(name="core_country")
 * @ORM\Entity
 */
class CoreCountry
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
     * @ORM\Column(name="code", type="string", length=128, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=3, nullable=false)
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_person", type="string", length=30, nullable=true)
     */
    private $contactPerson;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_phone", type="string", length=20, nullable=true)
     */
    private $contactPhone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_email", type="string", length=255, nullable=true)
     */
    private $contactEmail;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isActive = true;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=255, nullable=false)
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(name="unit1_name", type="string", length=30, nullable=false)
     */
    private $unit1Name;

    /**
     * @var string
     *
     * @ORM\Column(name="unit2_name", type="string", length=30, nullable=false)
     */
    private $unit2Name;

    /**
     * @var string
     *
     * @ORM\Column(name="unit3_name", type="string", length=30, nullable=false)
     */
    private $unit3Name;

    /**
     * @var string
     *
     * @ORM\Column(name="unit4_name", type="string", length=30, nullable=false)
     */
    private $unit4Name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dialing_code", type="string", length=5, nullable=true)
     */
    private $dialingCode;

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


}
