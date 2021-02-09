<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceBatchUploadDetailsCalving
 *
 * @ApiResource()
 * @ORM\Table(name="interface_batch_upload_details_calving")
 * @ORM\Entity
 */
class InterfaceBatchUploadDetailsCalving
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
     * @var string|null
     *
     * @ORM\Column(name="uuid", type="string", length=250, nullable=true)
     */
    private $uuid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dam_id", type="string", length=250, nullable=true)
     */
    private $damId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calving_date", type="string", length=250, nullable=true)
     */
    private $calvingDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calf_tag_id", type="string", length=250, nullable=true)
     */
    private $calfTagId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calf_name", type="string", length=250, nullable=true)
     */
    private $calfName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calf_birth_type", type="string", length=250, nullable=true)
     */
    private $calfBirthType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calving_method", type="string", length=250, nullable=true)
     */
    private $calvingMethod;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calving_type", type="string", length=250, nullable=true)
     */
    private $calvingType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ease_of_calving", type="string", length=250, nullable=true)
     */
    private $easeOfCalving;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calving_status", type="string", length=250, nullable=true)
     */
    private $calvingStatus;

    /**
     * @var string|null
     *
     * @ORM\Column(name="use_of_calf", type="string", length=250, nullable=true)
     */
    private $useOfCalf;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calf_body_condition", type="string", length=250, nullable=true)
     */
    private $calfBodyCondition;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calf_color", type="string", length=250, nullable=true)
     */
    private $calfColor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calf_deformaties", type="string", length=250, nullable=true)
     */
    private $calfDeformaties;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calf_gender", type="string", length=250, nullable=true)
     */
    private $calfGender;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calf_weight", type="string", length=250, nullable=true)
     */
    private $calfWeight;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calf_heart_girth", type="string", length=250, nullable=true)
     */
    private $calfHeartGirth;

    /**
     * @var int|null
     *
     * @ORM\Column(name="status", type="integer", nullable=true, options={"default"="1"})
     */
    private $status = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="notes", type="string", length=250, nullable=true)
     */
    private $notes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(?string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getDamId(): ?string
    {
        return $this->damId;
    }

    public function setDamId(?string $damId): self
    {
        $this->damId = $damId;

        return $this;
    }

    public function getCalvingDate(): ?string
    {
        return $this->calvingDate;
    }

    public function setCalvingDate(?string $calvingDate): self
    {
        $this->calvingDate = $calvingDate;

        return $this;
    }

    public function getCalfTagId(): ?string
    {
        return $this->calfTagId;
    }

    public function setCalfTagId(?string $calfTagId): self
    {
        $this->calfTagId = $calfTagId;

        return $this;
    }

    public function getCalfName(): ?string
    {
        return $this->calfName;
    }

    public function setCalfName(?string $calfName): self
    {
        $this->calfName = $calfName;

        return $this;
    }

    public function getCalfBirthType(): ?string
    {
        return $this->calfBirthType;
    }

    public function setCalfBirthType(?string $calfBirthType): self
    {
        $this->calfBirthType = $calfBirthType;

        return $this;
    }

    public function getCalvingMethod(): ?string
    {
        return $this->calvingMethod;
    }

    public function setCalvingMethod(?string $calvingMethod): self
    {
        $this->calvingMethod = $calvingMethod;

        return $this;
    }

    public function getCalvingType(): ?string
    {
        return $this->calvingType;
    }

    public function setCalvingType(?string $calvingType): self
    {
        $this->calvingType = $calvingType;

        return $this;
    }

    public function getEaseOfCalving(): ?string
    {
        return $this->easeOfCalving;
    }

    public function setEaseOfCalving(?string $easeOfCalving): self
    {
        $this->easeOfCalving = $easeOfCalving;

        return $this;
    }

    public function getCalvingStatus(): ?string
    {
        return $this->calvingStatus;
    }

    public function setCalvingStatus(?string $calvingStatus): self
    {
        $this->calvingStatus = $calvingStatus;

        return $this;
    }

    public function getUseOfCalf(): ?string
    {
        return $this->useOfCalf;
    }

    public function setUseOfCalf(?string $useOfCalf): self
    {
        $this->useOfCalf = $useOfCalf;

        return $this;
    }

    public function getCalfBodyCondition(): ?string
    {
        return $this->calfBodyCondition;
    }

    public function setCalfBodyCondition(?string $calfBodyCondition): self
    {
        $this->calfBodyCondition = $calfBodyCondition;

        return $this;
    }

    public function getCalfColor(): ?string
    {
        return $this->calfColor;
    }

    public function setCalfColor(?string $calfColor): self
    {
        $this->calfColor = $calfColor;

        return $this;
    }

    public function getCalfDeformaties(): ?string
    {
        return $this->calfDeformaties;
    }

    public function setCalfDeformaties(?string $calfDeformaties): self
    {
        $this->calfDeformaties = $calfDeformaties;

        return $this;
    }

    public function getCalfGender(): ?string
    {
        return $this->calfGender;
    }

    public function setCalfGender(?string $calfGender): self
    {
        $this->calfGender = $calfGender;

        return $this;
    }

    public function getCalfWeight(): ?string
    {
        return $this->calfWeight;
    }

    public function setCalfWeight(?string $calfWeight): self
    {
        $this->calfWeight = $calfWeight;

        return $this;
    }

    public function getCalfHeartGirth(): ?string
    {
        return $this->calfHeartGirth;
    }

    public function setCalfHeartGirth(?string $calfHeartGirth): self
    {
        $this->calfHeartGirth = $calfHeartGirth;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }


}
