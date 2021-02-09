<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreMasterCountry
 *
 * @ORM\Table(name="core_master_country", indexes={@ORM\Index(name="currency_id", columns={"currency"})})
 * @ORM\Entity
 */
class CoreMasterCountry
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
     * @ORM\Column(name="iso2", type="string", length=2, nullable=false)
     */
    private $iso2;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isActive = true;

    /**
     * @var string|null
     *
     * @ORM\Column(name="call_code", type="string", length=10, nullable=true)
     */
    private $callCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="currency", type="string", length=3, nullable=true)
     */
    private $currency;


}
