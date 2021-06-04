<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfNotif
 *
 * @ORM\Table(name="conf_notif", indexes={@ORM\Index(name="is_read", columns={"is_read"}), @ORM\Index(name="item_id", columns={"item_id"}), @ORM\Index(name="notif_type_id", columns={"notif_type_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class ConfNotif
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
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="item_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $itemId;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_read", type="boolean", nullable=false)
     */
    private $isRead = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="is_seen", type="boolean", nullable=false)
     */
    private $isSeen = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @var ConfNotifTypes
     *
     * @ORM\ManyToOne(targetEntity="ConfNotifTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="notif_type_id", referencedColumnName="id")
     * })
     */
    private $notifType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    public function setItemId(int $itemId): self
    {
        $this->itemId = $itemId;

        return $this;
    }

    public function getIsRead(): ?bool
    {
        return $this->isRead;
    }

    public function setIsRead(bool $isRead): self
    {
        $this->isRead = $isRead;

        return $this;
    }

    public function getIsSeen(): ?bool
    {
        return $this->isSeen;
    }

    public function setIsSeen(bool $isSeen): self
    {
        $this->isSeen = $isSeen;

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

    public function getNotifType(): ?ConfNotifTypes
    {
        return $this->notifType;
    }

    public function setNotifType(?ConfNotifTypes $notifType): self
    {
        $this->notifType = $notifType;

        return $this;
    }


}
