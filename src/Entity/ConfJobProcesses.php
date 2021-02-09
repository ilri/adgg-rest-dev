<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfJobProcesses
 *
 * @ORM\Table(name="conf_job_processes", indexes={@ORM\Index(name="job_id", columns={"job_id"})})
 * @ORM\Entity
 */
class ConfJobProcesses
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="job_id", type="string", length=255, nullable=false)
     */
    private $jobId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_run_datetime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $lastRunDatetime = 'CURRENT_TIMESTAMP';

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", nullable=false, options={"default"="1"})
     */
    private $status = true;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;


}
