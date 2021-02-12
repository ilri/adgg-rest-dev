<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * AndroidApps
 *
 * @ApiResource()
 * @ORM\Table(name="android_apps")
 * @ORM\Entity
 */
class AndroidApps
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
     * @ORM\Column(name="version_code", type="string", length=20, nullable=false)
     */
    private $versionCode;

    /**
     * @var string
     *
     * @ORM\Column(name="version_name", type="string", length=30, nullable=false)
     */
    private $versionName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="app_url", type="string", length=255, nullable=true)
     */
    private $appUrl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="apk_file", type="string", length=255, nullable=true)
     */
    private $apkFile;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isActive = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $createdBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVersionCode(): ?string
    {
        return $this->versionCode;
    }

    public function setVersionCode(string $versionCode): self
    {
        $this->versionCode = $versionCode;

        return $this;
    }

    public function getVersionName(): ?string
    {
        return $this->versionName;
    }

    public function setVersionName(string $versionName): self
    {
        $this->versionName = $versionName;

        return $this;
    }

    public function getAppUrl(): ?string
    {
        return $this->appUrl;
    }

    public function setAppUrl(?string $appUrl): self
    {
        $this->appUrl = $appUrl;

        return $this;
    }

    public function getApkFile(): ?string
    {
        return $this->apkFile;
    }

    public function setApkFile(?string $apkFile): self
    {
        $this->apkFile = $apkFile;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

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
