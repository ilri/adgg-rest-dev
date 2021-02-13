<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * AuthLog
 *
 * @ORM\Table(name="auth_log", indexes={@ORM\Index(name="userId", columns={"userId"})})
 * @ORM\Entity
 */
class AuthLog
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
     * @var int|null
     *
     * @ORM\Column(name="date", type="integer", nullable=true)
     */
    private $date;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="cookieBased", type="boolean", nullable=true)
     */
    private $cookiebased;

    /**
     * @var int|null
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var string|null
     *
     * @ORM\Column(name="error", type="string", length=255, nullable=true)
     */
    private $error;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ip", type="string", length=255, nullable=true)
     */
    private $ip;

    /**
     * @var string|null
     *
     * @ORM\Column(name="host", type="string", length=255, nullable=true)
     */
    private $host;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string|null
     *
     * @ORM\Column(name="userAgent", type="string", length=255, nullable=true)
     */
    private $useragent;

    /**
     * @var \AuthUsers
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userId", referencedColumnName="id")
     * })
     */
    private $userid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?int
    {
        return $this->date;
    }

    public function setDate(?int $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCookiebased(): ?bool
    {
        return $this->cookiebased;
    }

    public function setCookiebased(?bool $cookiebased): self
    {
        $this->cookiebased = $cookiebased;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function setError(?string $error): self
    {
        $this->error = $error;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function setHost(?string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getUseragent(): ?string
    {
        return $this->useragent;
    }

    public function setUseragent(?string $useragent): self
    {
        $this->useragent = $useragent;

        return $this;
    }

    public function getUserid(): ?User
    {
        return $this->userid;
    }

    public function setUserid(?User $userid): self
    {
        $this->userid = $userid;

        return $this;
    }


}
