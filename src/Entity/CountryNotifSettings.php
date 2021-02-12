<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * CountryNotifSettings
 *
 * @ApiResource()
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
    private $createdAt;

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

    public function getCountry(): ?CoreCountry
    {
        return $this->country;
    }

    public function setCountry(?CoreCountry $country): self
    {
        $this->country = $country;

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
