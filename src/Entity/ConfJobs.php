<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfJobs
 *
 * @ORM\Table(name="conf_jobs")
 * @ORM\Entity
 */
class ConfJobs
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=30, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_run", type="datetime", nullable=true)
     */
    private $lastRun;

    /**
     * @var bool
     *
     * @ORM\Column(name="execution_type", type="boolean", nullable=false, options={"default"="1"})
     */
    private $executionType = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isActive = true;

    /**
     * @var int
     *
     * @ORM\Column(name="threads", type="integer", nullable=false)
     */
    private $threads = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="max_threads", type="integer", nullable=false, options={"default"="3"})
     */
    private $maxThreads = '3';

    /**
     * @var int
     *
     * @ORM\Column(name="sleep", type="integer", nullable=false, options={"default"="5"})
     */
    private $sleep = '5';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="start_time", type="time", nullable=true)
     */
    private $startTime;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="end_time", type="time", nullable=true)
     */
    private $endTime;


}
