<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailOutbox
 *
 * @ORM\Table(name="email_outbox")
 * @ORM\Entity
 */
class EmailOutbox
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
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=16777215, nullable=false)
     */
    private $message;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subject", type="string", length=255, nullable=true)
     */
    private $subject;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sender_name", type="string", length=60, nullable=true)
     */
    private $senderName;

    /**
     * @var string
     *
     * @ORM\Column(name="sender_email", type="string", length=128, nullable=false)
     */
    private $senderEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="recipient_email", type="string", length=128, nullable=false)
     */
    private $recipientEmail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="attachment", type="string", length=1000, nullable=true)
     */
    private $attachment;

    /**
     * @var string|null
     *
     * @ORM\Column(name="attachment_mime_type", type="string", length=128, nullable=true)
     */
    private $attachmentMimeType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cc", type="string", length=1000, nullable=true)
     */
    private $cc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bcc", type="string", length=1000, nullable=true)
     */
    private $bcc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="template_id", type="string", length=128, nullable=true)
     */
    private $templateId;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", nullable=false, options={"default"="1"})
     */
    private $status = true;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ref_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $refId;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_queued", type="datetime", nullable=true)
     */
    private $dateQueued;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_sent", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateSent = 'CURRENT_TIMESTAMP';

    /**
     * @var bool
     *
     * @ORM\Column(name="attempts", type="boolean", nullable=false)
     */
    private $attempts = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $createdBy;


}
