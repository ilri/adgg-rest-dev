<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysAppSession
 *
 * @ORM\Table(name="sys_app_session", indexes={@ORM\Index(name="expire", columns={"expire"})})
 * @ORM\Entity
 */
class SysAppSession
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="expire", type="integer", nullable=false)
     */
    private $expire;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="blob", length=65535, nullable=false)
     */
    private $data;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getExpire(): ?int
    {
        return $this->expire;
    }

    public function setExpire(int $expire): self
    {
        $this->expire = $expire;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }
}
