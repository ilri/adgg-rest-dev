<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MobFormRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="mob_form")
 * @ORM\Entity(repositoryClass=MobFormRepository::class)
 */
#[ApiResource]
class MobForm
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var int|null
     *
     * @ORM\Column(name="pic_min", type="integer", nullable=true)
     */
    private $pic_min;

    /**
     * @var int|null
     *
     * @ORM\Column(name="pic_max", type="integer", nullable=true)
     */
    private $pic_max;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ltype", type="integer")
     */
    private $ltype;

    /**
     * @var int|null
     *
     * @ORM\Column(name="added_by", type="integer")
     */
    private $added_by;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=true)
     */
    private $datetime;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ip_address", type="string", length=100, nullable=true)
     */
    private $ip_address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dormant", type="text", nullable=true)
     */
    private $dormant;

    /**
     * @var int|null
     *
     * @ORM\Column(name="slno", type="integer", nullable=true)
     */
    private $slno;

    /**
     * @var int|null
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPicMin(): ?int
    {
        return $this->pic_min;
    }

    public function setPicMin(?int $pic_min): self
    {
        $this->pic_min = $pic_min;

        return $this;
    }

    public function getPicMax(): ?int
    {
        return $this->pic_max;
    }

    public function setPicMax(?int $pic_max): self
    {
        $this->pic_max = $pic_max;

        return $this;
    }

    public function getLtype(): ?int
    {
        return $this->ltype;
    }

    public function setLtype(int $ltype): self
    {
        $this->ltype = $ltype;

        return $this;
    }

    public function getAddedBy(): ?int
    {
        return $this->added_by;
    }

    public function setAddedBy(int $added_by): self
    {
        $this->added_by = $added_by;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(?\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getIpAddress(): ?string
    {
        return $this->ip_address;
    }

    public function setIpAddress(?string $ip_address): self
    {
        $this->ip_address = $ip_address;

        return $this;
    }

    public function getDormant(): ?string
    {
        return $this->dormant;
    }

    public function setDormant(?string $dormant): self
    {
        $this->dormant = $dormant;

        return $this;
    }

    public function getSlno(): ?int
    {
        return $this->slno;
    }

    public function setSlno(?int $slno): self
    {
        $this->slno = $slno;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
