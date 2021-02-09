<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthLog
 *
 * @ORM\Table(name="auth_log", indexes={@ORM\Index(name="userId", columns={"userId"})})
 * @ORM\Entity
 */
class AuthLog
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
     * @ORM\Column(name="date", type="integer", nullable=true)
     */
    private $date;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="cookieBased", type="boolean", nullable=true)
     */
    private $cookiebased;

    /**
     * @var int|null
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var string|null
     *
     * @ORM\Column(name="error", type="string", length=255, nullable=true)
     */
    private $error;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ip", type="string", length=255, nullable=true)
     */
    private $ip;

    /**
     * @var string|null
     *
     * @ORM\Column(name="host", type="string", length=255, nullable=true)
     */
    private $host;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string|null
     *
     * @ORM\Column(name="userAgent", type="string", length=255, nullable=true)
     */
    private $useragent;

    /**
     * @var \AuthUsers
     *
     * @ORM\ManyToOne(targetEntity="AuthUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userId", referencedColumnName="id")
     * })
     */
    private $userid;


}
