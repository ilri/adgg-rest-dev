<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceBatchUploadDetailsInsemination
 *
 * @ORM\Table(name="interface_batch_upload_details_insemination")
 * @ORM\Entity
 */
class InterfaceBatchUploadDetailsInsemination
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
     * @ORM\Column(name="service_date", type="string", length=250, nullable=true)
     */
    private $serviceDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ai_type", type="string", length=250, nullable=true)
     */
    private $aiType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="straw_id", type="string", length=250, nullable=true)
     */
    private $strawId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="body_score", type="string", length=250, nullable=true)
     */
    private $bodyScore;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cost", type="string", length=250, nullable=true)
     */
    private $cost;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ai_tech", type="string", length=250, nullable=true)
     */
    private $aiTech;

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
