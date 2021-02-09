<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * AuthUsersNotificationSettings
 *
 * @ApiResource()
 * @ORM\Table(name="auth_users_notification_settings", indexes={@ORM\Index(name="notification_id", columns={"notification_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class AuthUsersNotificationSettings
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

    /**
     * @var \AuthUsers
     *
     * @ORM\ManyToOne(targetEntity="AuthUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \ConfNotifTypes
     *
     * @ORM\ManyToOne(targetEntity="ConfNotifTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="notification_id", referencedColumnName="id")
     * })
     */
    private $notification;

    public function getId(): ?int
    {
        return $this->id;
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

    public function setEnableSmsNotification(bool $enableSmsNotification): self
    {
        $this->enableSmsNotification = $enableSmsNotification;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?int $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getUser(): ?AuthUsers
    {
        return $this->user;
    }

    public function setUser(?AuthUsers $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getNotification(): ?ConfNotifTypes
    {
        return $this->notification;
    }

    public function setNotification(?ConfNotifTypes $notification): self
    {
        $this->notification = $notification;

        return $this;
    }


}
