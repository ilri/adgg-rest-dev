<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfNotifTypes
 *
 * @ORM\Table(name="conf_notif_types")
 * @ORM\Entity
 */
class ConfNotifTypes
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=60, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=500, nullable=false)
     */
    private $template;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email_template_id", type="string", length=128, nullable=true)
     */
    private $emailTemplateId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sms_template_id", type="string", length=128, nullable=true)
     */
    private $smsTemplateId;

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
     * @var bool|null
     *
     * @ORM\Column(name="enable_sms_notification", type="boolean", nullable=true)
     */
    private $enableSmsNotification = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="notify_all_users", type="boolean", nullable=false)
     */
    private $notifyAllUsers = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="notify_days_before", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $notifyDaysBefore;

    /**
     * @var string
     *
     * @ORM\Column(name="model_class_name", type="string", length=60, nullable=false)
     */
    private $modelClassName;

    /**
     * @var string
     *
     * @ORM\Column(name="fa_icon_class", type="string", length=30, nullable=false, options={"default"="fa-bell"})
     */
    private $faIconClass = 'fa-bell';

    /**
     * @var bool
     *
     * @ORM\Column(name="notification_trigger", type="boolean", nullable=false, options={"default"="1"})
     */
    private $notificationTrigger = true;

    /**
     * @var int
     *
     * @ORM\Column(name="max_notifications", type="integer", nullable=false, options={"default"="1"})
     */
    private $maxNotifications = '1';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="notification_time", type="time", nullable=true)
     */
    private $notificationTime;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isActive = true;

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
     * @ORM\Column(name="created_by", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $createdBy;


}
