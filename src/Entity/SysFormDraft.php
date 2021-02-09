<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysFormDraft
 *
 * @ORM\Table(name="sys_form_draft")
 * @ORM\Entity
 */
class SysFormDraft
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
     * @var json
     *
     * @ORM\Column(name="model_attributes", type="json", nullable=false)
     */
    private $modelAttributes;

    /**
     * @var string
     *
     * @ORM\Column(name="model_class", type="string", length=1000, nullable=false)
     */
    private $modelClass;

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


}
