<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
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
    private $lastRunDatetime;

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

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getJobId(): ?string
    {
        return $this->jobId;
    }

    public function setJobId(string $jobId): self
    {
        $this->jobId = $jobId;

        return $this;
    }

    public function getLastRunDatetime(): ?\DateTimeInterface
    {
        return $this->lastRunDatetime;
    }

    public function setLastRunDatetime(\DateTimeInterface $lastRunDatetime): self
    {
        $this->lastRunDatetime = $lastRunDatetime;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


}
