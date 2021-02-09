<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceBatchUploadDetailsPd
 *
 * @ORM\Table(name="interface_batch_upload_details_pd")
 * @ORM\Entity
 */
class InterfaceBatchUploadDetailsPd
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
     * @ORM\Column(name="animal_id", type="string", length=250, nullable=true)
     */
    private $animalId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="exam_date", type="string", length=250, nullable=true)
     */
    private $examDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pd_method", type="string", length=250, nullable=true)
     */
    private $pdMethod;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pd_results", type="string", length=250, nullable=true)
     */
    private $pdResults;

    /**
     * @var string|null
     *
     * @ORM\Column(name="stage", type="string", length=250, nullable=true)
     */
    private $stage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="body_condition", type="string", length=250, nullable=true)
     */
    private $bodyCondition;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pd_cost", type="string", length=250, nullable=true)
     */
    private $pdCost;

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
