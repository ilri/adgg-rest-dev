<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysQueue
 *
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


}
