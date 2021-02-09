<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceGraduationList
 *
 * @ORM\Table(name="interface_graduation_list")
 * @ORM\Entity
 */
class InterfaceGraduationList
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
     * @ORM\Column(name="animal_id", type="integer", nullable=true)
     */
    private $animalId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="graduate_from", type="integer", nullable=true)
     */
    private $graduateFrom;

    /**
     * @var int|null
     *
     * @ORM\Column(name="graduate_to", type="integer", nullable=true)
     */
    private $graduateTo;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="status_id", type="boolean", nullable=true)
     */
    private $statusId = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="graduation_process_id", type="integer", nullable=true)
     */
    private $graduationProcessId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="action", type="string", length=100, nullable=true)
     */
    private $action;

    /**
     * @var string|null
     *
     * @ORM\Column(name="uuid", type="string", length=250, nullable=true)
     */
    private $uuid;

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
