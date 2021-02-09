<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthAuditTrail
 *
 * @ORM\Table(name="auth_audit_trail", indexes={@ORM\Index(name="sacco_id", columns={"country_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class AuthAuditTrail
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="action", type="boolean", nullable=false)
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="action_description", type="string", length=1000, nullable=false)
     */
    private $actionDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=1000, nullable=false)
     */
    private $url;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ip_address", type="string", length=30, nullable=true)
     */
    private $ipAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="user_agent", type="string", length=1000, nullable=true)
     */
    private $userAgent;

    /**
     * @var int|null
     *
     * @ORM\Column(name="country_id", type="integer", nullable=true)
     */
    private $countryId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="details", type="text", length=65535, nullable=true)
     */
    private $details;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \AuthUsers
     *
     * @ORM\ManyToOne(targetEntity="AuthUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


}
