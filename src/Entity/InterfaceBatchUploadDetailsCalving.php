<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceBatchUploadDetailsCalving
 *
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


}
