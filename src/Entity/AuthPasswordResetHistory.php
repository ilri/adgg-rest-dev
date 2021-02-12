<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * AuthPasswordResetHistory
 *
 * @ApiResource()
 * @ORM\Table(name="auth_password_reset_history", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class AuthPasswordResetHistory
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
     * @ORM\Column(name="old_password_hash", type="string", length=255, nullable=false)
     */
    private $oldPasswordHash;

    /**
     * @var string
     *
     * @ORM\Column(name="new_password_hash", type="string", length=255, nullable=false)
     */
    private $newPasswordHash;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ip_address", type="string", length=128, nullable=true)
     */
    private $ipAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password_reset_token", type="string", length=255, nullable=true)
     */
    private $passwordResetToken;

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
     * @var \AuthUsers
     *
     * @ORM\ManyToOne(targetEntity="AuthUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOldPasswordHash(): ?string
    {
        return $this->oldPasswordHash;
    }

    public function setOldPasswordHash(string $oldPasswordHash): self
    {
        $this->oldPasswordHash = $oldPasswordHash;

        return $this;
    }

    public function getNewPasswordHash(): ?string
    {
        return $this->newPasswordHash;
    }

    public function setNewPasswordHash(string $newPasswordHash): self
    {
        $this->newPasswordHash = $newPasswordHash;

        return $this;
    }

    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    public function setIpAddress(?string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    public function getPasswordResetToken(): ?string
    {
        return $this->passwordResetToken;
    }

    public function setPasswordResetToken(?string $passwordResetToken): self
    {
        $this->passwordResetToken = $passwordResetToken;

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

    public function getUser(): ?AuthUsers
    {
        return $this->user;
    }

    public function setUser(?AuthUsers $user): self
    {
        $this->user = $user;

        return $this;
    }


}
