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
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMsisdn(): ?string
    {
        return $this->msisdn;
    }

    public function setMsisdn(string $msisdn): self
    {
        $this->msisdn = $msisdn;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getSenderId(): ?string
    {
        return $this->senderId;
    }

    public function setSenderId(string $senderId): self
    {
        $this->senderId = $senderId;

        return $this;
    }

    public function getSendStatus(): ?bool
    {
        return $this->sendStatus;
    }

    public function setSendStatus(bool $sendStatus): self
    {
        $this->sendStatus = $sendStatus;

        return $this;
    }

    public function getResponseCode(): ?string
    {
        return $this->responseCode;
    }

    public function setResponseCode(?string $responseCode): self
    {
        $this->responseCode = $responseCode;

        return $this;
    }

    public function getResponseRemarks(): ?string
    {
        return $this->responseRemarks;
    }

    public function setResponseRemarks(?string $responseRemarks): self
    {
        $this->responseRemarks = $responseRemarks;

        return $this;
    }

    public function getAttempts(): ?int
    {
        return $this->attempts;
    }

    public function setAttempts(int $attempts): self
    {
        $this->attempts = $attempts;

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
