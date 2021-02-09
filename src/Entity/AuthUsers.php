<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthUsers
 *
 * @ORM\Table(name="auth_users", uniqueConstraints={@ORM\UniqueConstraint(name="username", columns={"username"})}, indexes={@ORM\Index(name="branch_id", columns={"branch_id"}), @ORM\Index(name="org_id", columns={"country_id"}), @ORM\Index(name="phone", columns={"phone"}), @ORM\Index(name="role_id", columns={"role_id"}), @ORM\Index(name="user_level", columns={"level_id"})})
 * @ORM\Entity
 */
class AuthUsers
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
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=30, nullable=false)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=15, nullable=true)
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="smallint", nullable=false, options={"default"="1"})
     */
    private $status = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="timezone", type="string", length=60, nullable=true)
     */
    private $timezone;

    /**
     * @var string
     *
     * @ORM\Column(name="password_hash", type="string", length=255, nullable=false)
     */
    private $passwordHash;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password_reset_token", type="string", length=255, nullable=true)
     */
    private $passwordResetToken;

    /**
     * @var string|null
     *
     * @ORM\Column(name="auth_key", type="string", length=255, nullable=true)
     */
    private $authKey;

    /**
     * @var string|null
     *
     * @ORM\Column(name="account_activation_token", type="string", length=255, nullable=true)
     */
    private $accountActivationToken;

    /**
     * @var int|null
     *
     * @ORM\Column(name="region_id", type="integer", nullable=true)
     */
    private $regionId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="district_id", type="integer", nullable=true)
     */
    private $districtId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ward_id", type="integer", nullable=true)
     */
    private $wardId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="village_id", type="integer", nullable=true)
     */
    private $villageId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="org_id", type="integer", nullable=true)
     */
    private $orgId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="client_id", type="integer", nullable=true)
     */
    private $clientId;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_main_account", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isMainAccount = true;

    /**
     * @var string|null
     *
     * @ORM\Column(name="profile_image", type="string", length=255, nullable=true)
     */
    private $profileImage;

    /**
     * @var bool
     *
     * @ORM\Column(name="require_password_change", type="boolean", nullable=false, options={"default"="1"})
     */
    private $requirePasswordChange = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="auto_generate_password", type="boolean", nullable=false)
     */
    private $autoGeneratePassword = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="branch_id", type="integer", nullable=true)
     */
    private $branchId;

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

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=true)
     */
    private $updatedBy;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_deleted", type="boolean", nullable=true)
     */
    private $isDeleted = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="deleted_by", type="integer", nullable=true)
     */
    private $deletedBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    private $lastLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=256, nullable=false)
     */
    private $uuid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="odk_code", type="string", length=30, nullable=true)
     */
    private $odkCode;

    /**
     * @var json|null
     *
     * @ORM\Column(name="additional_attributes", type="json", nullable=true)
     */
    private $additionalAttributes;

    /**
     * @var string|null
     *
     * @ORM\Column(name="odk_form_uuid", type="string", length=128, nullable=true)
     */
    private $odkFormUuid;

    /**
     * @var \AuthUserLevels
     *
     * @ORM\ManyToOne(targetEntity="AuthUserLevels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="level_id", referencedColumnName="id")
     * })
     */
    private $level;

    /**
     * @var \AuthRoles
     *
     * @ORM\ManyToOne(targetEntity="AuthRoles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    private $role;

    /**
     * @var \CoreCountry
     *
     * @ORM\ManyToOne(targetEntity="CoreCountry")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    private $country;


}
