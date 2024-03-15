<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ApiLogsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="api_logs")
 * @ORM\Entity(repositoryClass=ApiLogsRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
#[ApiResource]
class ApiLogs
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="created_by",type="integer")
     */
    private $userId;

    /**
     * @ORM\Column(name="payload_response",type="text", nullable=true)
     */
    private $payloadResponse;

    /**
     * @ORM\Column(name="payload_request",type="text", nullable=true)
     */
    private $payloadRequest;

    /**
     * @ORM\Column(name="request_uri",type="string", length=500, nullable=true)
     */
    private $requestUri;

    /**
     * @ORM\Column(name="http_status_code",type="string", length=500, nullable=true)
     */
    private $statusCode;

    /**
     * @ORM\Column(name="request_method",type="string", length=500, nullable=true)
     */
    private $requestMethod;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

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

    public function getPayloadResponse(): ?string
    {
        return $this->payloadResponse;
    }

    public function setPayloadResponse(?string $payloadResponse): self
    {
        $this->payloadResponse = $payloadResponse;

        return $this;
    }

    public function getPayloadRequest(): ?string
    {
        return $this->payloadRequest;
    }

    public function setPayloadRequest(?string $payloadRequest): self
    {
        $this->payloadRequest = $payloadRequest;

        return $this;
    }

    public function getRequestUri(): ?string
    {
        return $this->requestUri;
    }

    public function setRequestUri(?string $requestUri): self
    {
        $this->requestUri = $requestUri;

        return $this;
    }

    public function getStatusCode(): ?string
    {
        return $this->statusCode;
    }

    public function setStatusCode(?string $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getRequestMethod(): ?string
    {
        return $this->requestMethod;
    }


    public function setRequestMethod(?string $requestMethod): self
    {
        $this->requestMethod = $requestMethod;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist()
     */
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }
}
