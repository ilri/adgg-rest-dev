<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceBatchUploadDetailsWeight
 *
 * @ORM\Table(name="interface_batch_upload_details_weight")
 * @ORM\Entity
 */
class InterfaceBatchUploadDetailsWeight
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
     * @ORM\Column(name="weight_date", type="string", length=250, nullable=true)
     */
    private $weightDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="body_length", type="string", length=250, nullable=true)
     */
    private $bodyLength;

    /**
     * @var string|null
     *
     * @ORM\Column(name="heart_girth", type="string", length=250, nullable=true)
     */
    private $heartGirth;

    /**
     * @var string|null
     *
     * @ORM\Column(name="body_weight", type="string", length=250, nullable=true)
     */
    private $bodyWeight;

    /**
     * @var string|null
     *
     * @ORM\Column(name="body_score", type="string", length=250, nullable=true)
     */
    private $bodyScore;

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
