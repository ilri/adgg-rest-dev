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
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \ConfNotifTypes
     *
     * @ORM\ManyToOne(targetEntity="ConfNotifTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="notif_type_id", referencedColumnName="id")
     * })
     */
    private $notifType;


}
