<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * ConfNotifQueue
 *
 * @ApiResource()
 * @ORM\Table(name="conf_notif_queue")
 * @ORM\Entity
 */
class ConfNotifQueue
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
     * @ORM\Column(name="notif_type_id", type="string", length=128, nullable=false)
     */
    private $notifTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="item_id", type="string", length=128, nullable=false)
     */
    private $itemId;

    /**
     * @var int
     *
     * @ORM\Column(name="max_notifications", type="integer", nullable=false, options={"default"="1"})
     */
    private $maxNotifications = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="notifications_count", type="integer", nullable=false, options={"default"="1"})
     */
    private $notificationsCount = '1';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="notification_time", type="time", nullable=true, options={"default"="08:00:00"})
     */
    private $notificationTime = '08:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNotifTypeId(): ?string
    {
        return $this->notifTypeId;
    }

    public function setNotifTypeId(string $notifTypeId): self
    {
        $this->notifTypeId = $notifTypeId;

        return $this;
    }

    public function getItemId(): ?string
    {
        return $this->itemId;
    }

    public function setItemId(string $itemId): self
    {
        $this->itemId = $itemId;

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

    public function getNotificationsCount(): ?int
    {
        return $this->notificationsCount;
    }

    public function setNotificationsCount(int $notificationsCount): self
    {
        $this->notificationsCount = $notificationsCount;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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


}
