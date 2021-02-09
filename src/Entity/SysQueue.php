<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * SysQueue
 *
 * @ApiResource()
 * @ORM\Table(name="sys_queue", indexes={@ORM\Index(name="channel", columns={"channel"}), @ORM\Index(name="priority", columns={"priority"}), @ORM\Index(name="reserved_at", columns={"reserved_at"})})
 * @ORM\Entity
 */
class SysQueue
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
     * @var string
     *
     * @ORM\Column(name="channel", type="string", length=255, nullable=false)
     */
    private $channel;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="blob", length=0, nullable=false)
     */
    private $job;

    /**
     * @var int
     *
     * @ORM\Column(name="pushed_at", type="integer", nullable=false)
     */
    private $pushedAt;

    /**
     * @var int
     *
     * @ORM\Column(name="ttr", type="integer", nullable=false)
     */
    private $ttr;

    /**
     * @var int
     *
     * @ORM\Column(name="delay", type="integer", nullable=false)
     */
    private $delay = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="priority", type="integer", nullable=false, options={"default"="1024","unsigned"=true})
     */
    private $priority = '1024';

    /**
     * @var int|null
     *
     * @ORM\Column(name="reserved_at", type="integer", nullable=true)
     */
    private $reservedAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="attempt", type="integer", nullable=true)
     */
    private $attempt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="done_at", type="integer", nullable=true)
     */
    private $doneAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    public function setChannel(string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    public function getJob()
    {
        return $this->job;
    }

    public function setJob($job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getPushedAt(): ?int
    {
        return $this->pushedAt;
    }

    public function setPushedAt(int $pushedAt): self
    {
        $this->pushedAt = $pushedAt;

        return $this;
    }

    public function getTtr(): ?int
    {
        return $this->ttr;
    }

    public function setTtr(int $ttr): self
    {
        $this->ttr = $ttr;

        return $this;
    }

    public function getDelay(): ?int
    {
        return $this->delay;
    }

    public function setDelay(int $delay): self
    {
        $this->delay = $delay;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getReservedAt(): ?int
    {
        return $this->reservedAt;
    }

    public function setReservedAt(?int $reservedAt): self
    {
        $this->reservedAt = $reservedAt;

        return $this;
    }

    public function getAttempt(): ?int
    {
        return $this->attempt;
    }

    public function setAttempt(?int $attempt): self
    {
        $this->attempt = $attempt;

        return $this;
    }

    public function getDoneAt(): ?int
    {
        return $this->doneAt;
    }

    public function setDoneAt(?int $doneAt): self
    {
        $this->doneAt = $doneAt;

        return $this;
    }


}
