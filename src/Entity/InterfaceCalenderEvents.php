<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceCalenderEvents
 *
 * @ORM\Table(name="interface_calender_events")
 * @ORM\Entity
 */
class InterfaceCalenderEvents
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
     * @ORM\Column(name="title", type="string", length=250, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_start_datetime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $eventStartDatetime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_end_datetime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $eventEndDatetime;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="all_day", type="boolean", nullable=true)
     */
    private $allDay = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="org_id", type="integer", nullable=true)
     */
    private $orgId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="color", type="integer", nullable=true)
     */
    private $color;

    /**
     * @var string|null
     *
     * @ORM\Column(name="uuid", type="string", length=100, nullable=true)
     */
    private $uuid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=true)
     */
    private $updatedBy;

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

    public function getEventStartDatetime(): ?\DateTimeInterface
    {
        return $this->eventStartDatetime;
    }

    public function setEventStartDatetime(\DateTimeInterface $eventStartDatetime): self
    {
        $this->eventStartDatetime = $eventStartDatetime;

        return $this;
    }

    public function getEventEndDatetime(): ?\DateTimeInterface
    {
        return $this->eventEndDatetime;
    }

    public function setEventEndDatetime(\DateTimeInterface $eventEndDatetime): self
    {
        $this->eventEndDatetime = $eventEndDatetime;

        return $this;
    }

    public function getAllDay(): ?bool
    {
        return $this->allDay;
    }

    public function setAllDay(?bool $allDay): self
    {
        $this->allDay = $allDay;

        return $this;
    }

    public function getOrgId(): ?int
    {
        return $this->orgId;
    }

    public function setOrgId(?int $orgId): self
    {
        $this->orgId = $orgId;

        return $this;
    }

    public function getColor(): ?int
    {
        return $this->color;
    }

    public function setColor(?int $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(?string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?int $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?int $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }


}
