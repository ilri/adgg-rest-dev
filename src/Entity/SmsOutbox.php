<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SmsOutbox
 *
 * @ORM\Table(name="sms_outbox")
 * @ORM\Entity
 */
class SmsOutbox
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
     * @ORM\Column(name="msisdn", type="string", length=15, nullable=false)
     */
    private $msisdn;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=1000, nullable=false)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="sender_id", type="string", length=20, nullable=false)
     */
    private $senderId;

    /**
     * @var bool
     *
     * @ORM\Column(name="send_status", type="boolean", nullable=false)
     */
    private $sendStatus;

    /**
     * @var string|null
     *
     * @ORM\Column(name="response_code", type="string", length=20, nullable=true)
     */
    private $responseCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="response_remarks", type="string", length=1000, nullable=true)
     */
    private $responseRemarks;

    /**
     * @var int
     *
     * @ORM\Column(name="attempts", type="integer", nullable=false, options={"default"="1"})
     */
    private $attempts = '1';

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


}
