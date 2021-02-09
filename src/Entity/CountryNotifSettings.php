<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CountryNotifSettings
 *
 * @ORM\Table(name="country_notif_settings", indexes={@ORM\Index(name="notification_id", columns={"notification_id"}), @ORM\Index(name="trader_id", columns={"country_id"})})
 * @ORM\Entity
 */
class CountryNotifSettings
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
     * @var bool
     *
     * @ORM\Column(name="enable_internal_notification", type="boolean", nullable=false, options={"default"="1"})
     */
    private $enableInternalNotification = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="enable_email_notification", type="boolean", nullable=false, options={"default"="1"})
     */
    private $enableEmailNotification = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="enable_sms_notification", type="boolean", nullable=false)
     */
    private $enableSmsNotification = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="users", type="string", length=1000, nullable=true)
     */
    private $users;

    /**
     * @var string|null
     *
     * @ORM\Column(name="roles", type="string", length=1000, nullable=true)
     */
    private $roles;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=1000, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=1000, nullable=true)
     */
    private $phone;

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
     * @var \CoreCountry
     *
     * @ORM\ManyToOne(targetEntity="CoreCountry")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    private $country;

    /**
     * @var \ConfNotifTypes
     *
     * @ORM\ManyToOne(targetEntity="ConfNotifTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="notification_id", referencedColumnName="id")
     * })
     */
    private $notification;


}
