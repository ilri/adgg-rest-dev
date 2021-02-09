<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceGraduationSettings
 *
 * @ORM\Table(name="interface_graduation_settings")
 * @ORM\Entity
 */
class InterfaceGraduationSettings
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
     * @ORM\Column(name="org_id", type="integer", nullable=true)
     */
    private $orgId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="graduation_parameter", type="string", length=250, nullable=true)
     */
    private $graduationParameter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=250, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="graduate_from", type="string", length=250, nullable=true)
     */
    private $graduateFrom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="graduate_to", type="string", length=250, nullable=true)
     */
    private $graduateTo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="graduation_value", type="string", length=250, nullable=true)
     */
    private $graduationValue;

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


}
