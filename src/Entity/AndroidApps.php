<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AndroidApps
 *
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
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $createdBy;


}
