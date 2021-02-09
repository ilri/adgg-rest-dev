<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfNumberingFormat
 *
 * @ORM\Table(name="conf_numbering_format", indexes={@ORM\Index(name="code", columns={"code"}), @ORM\Index(name="org_id", columns={"country_id"})})
 * @ORM\Entity
 */
class ConfNumberingFormat
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
     * @ORM\Column(name="code", type="string", length=60, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="next_number", type="integer", nullable=false, options={"default"="1"})
     */
    private $nextNumber = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="min_digits", type="smallint", nullable=false, options={"default"="3"})
     */
    private $minDigits = '3';

    /**
     * @var string|null
     *
     * @ORM\Column(name="prefix", type="string", length=5, nullable=true)
     */
    private $prefix;

    /**
     * @var string|null
     *
     * @ORM\Column(name="suffix", type="string", length=5, nullable=true)
     */
    private $suffix;

    /**
     * @var string|null
     *
     * @ORM\Column(name="preview", type="string", length=128, nullable=true)
     */
    private $preview;

    /**
     * @var int|null
     *
     * @ORM\Column(name="country_id", type="integer", nullable=true)
     */
    private $countryId;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_private", type="boolean", nullable=false)
     */
    private $isPrivate = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isActive = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $createdBy;


}
