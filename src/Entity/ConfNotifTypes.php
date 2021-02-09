<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * ConfNotifTypes
 *
 * @ApiResource()
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

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getEmailTemplateId(): ?string
    {
        return $this->emailTemplateId;
    }

    public function setEmailTemplateId(?string $emailTemplateId): self
    {
        $this->emailTemplateId = $emailTemplateId;

        return $this;
    }

    public function getSmsTemplateId(): ?string
    {
        return $this->smsTemplateId;
    }

    public function setSmsTemplateId(?string $smsTemplateId): self
    {
        $this->smsTemplateId = $smsTemplateId;

        return $this;
    }

    public function getEnableInternalNotification(): ?bool
    {
        return $this->enableInternalNotification;
    }

    public function setEnableInternalNotification(bool $enableInternalNotification): self
    {
        $this->enableInternalNotification = $enableInternalNotification;

        return $this;
    }

    public function getEnableEmailNotification(): ?bool
    {
        return $this->enableEmailNotification;
    }

    public function setEnableEmailNotification(bool $enableEmailNotification): self
    {
        $this->enableEmailNotification = $enableEmailNotification;

        return $this;
    }

    public function getEnableSmsNotification(): ?bool
    {
        return $this->enableSmsNotification;
    }

    public function setEnableSmsNotification(?bool $enableSmsNotification): self
    {
        $this->enableSmsNotification = $enableSmsNotification;

        return $this;
    }

    public function getNotifyAllUsers(): ?bool
    {
        return $this->notifyAllUsers;
    }

    public function setNotifyAllUsers(bool $notifyAllUsers): self
    {
        $this->notifyAllUsers = $notifyAllUsers;

        return $this;
    }

    public function getNotifyDaysBefore(): ?int
    {
        return $this->notifyDaysBefore;
    }

    public function setNotifyDaysBefore(?int $notifyDaysBefore): self
    {
        $this->notifyDaysBefore = $notifyDaysBefore;

        return $this;
    }

    public function getModelClassName(): ?string
    {
        return $this->modelClassName;
    }

    public function setModelClassName(string $modelClassName): self
    {
        $this->modelClassName = $modelClassName;

        return $this;
    }

    public function getFaIconClass(): ?string
    {
        return $this->faIconClass;
    }

    public function setFaIconClass(string $faIconClass): self
    {
        $this->faIconClass = $faIconClass;

        return $this;
    }

    public function getNotificationTrigger(): ?bool
    {
        return $this->notificationTrigger;
    }

    public function setNotificationTrigger(bool $notificationTrigger): self
    {
        $this->notificationTrigger = $notificationTrigger;

        return $this;
    }

    public function getMaxNotifications(): ?int
    {
        return $this->maxNotifications;
    }

    public function setMaxNotifications(int $maxNotifications): self
    {
        $this->maxNotifications = $maxNotifications;

        return $this;
    }

    public function getNotificationTime(): ?\DateTimeInterface
    {
        return $this->notificationTime;
    }

    public function setNotificationTime(?\DateTimeInterface $notificationTime): self
    {
        $this->notificationTime = $notificationTime;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getUsers(): ?string
    {
        return $this->users;
    }

    public function setUsers(?string $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getRoles(): ?string
    {
        return $this->roles;
    }

    public function setRoles(?string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?int $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }


}
