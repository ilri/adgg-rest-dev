<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MobFormFieldMultipleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="form_field_multiple")
 * @ORM\Entity(repositoryClass=MobFormFieldMultipleRepository::class)
 */
#[ApiResource]
class MobFormFieldMultiple
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="multi_id", type="integer")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="form_id",  type="integer", nullable=true)
     */
    private $form_id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="field_id",  type="integer", nullable=true)
     */
    private $field_id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="label",  type="string", length=255)
     */
    private $label;

    /**
     * @var string|null
     *
     * @ORM\Column(name="selected", type="string", length=255, nullable=true)
     */
    private $selected;

    /**
     * @var string|null
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=true)
     */
    private $value;

    /**
     * @var int|null
     *
     * @ORM\Column(name="order_by",  type="integer", nullable=true)
     */
    private $order_by;

    /**
     * @var int|null
     *
     * @ORM\Column(name="added_by",  type="integer", nullable=true)
     */
    private $added_by;

    /**
     * @var int|null
     *
     * @ORM\Column(name="added_datetime", type="datetime", nullable=true)
     */
    private $added_datetime;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ip_address",  type="string", length=100, nullable=true)
     */
    private $ip_address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=5, nullable=true)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormId(): ?int
    {
        return $this->form_id;
    }

    public function setFormId(?int $form_id): self
    {
        $this->form_id = $form_id;

        return $this;
    }

    public function getFieldId(): ?int
    {
        return $this->field_id;
    }

    public function setFieldId(int $field_id): self
    {
        $this->field_id = $field_id;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getSelected(): ?string
    {
        return $this->selected;
    }

    public function setSelected(?string $selected): self
    {
        $this->selected = $selected;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getOrderBy(): ?int
    {
        return $this->order_by;
    }

    public function setOrderBy(?int $order_by): self
    {
        $this->order_by = $order_by;

        return $this;
    }

    public function getAddedBy(): ?int
    {
        return $this->added_by;
    }

    public function setAddedBy(?int $added_by): self
    {
        $this->added_by = $added_by;

        return $this;
    }

    public function getAddedDatetime(): ?\DateTimeInterface
    {
        return $this->added_datetime;
    }

    public function setAddedDatetime(?\DateTimeInterface $added_datetime): self
    {
        $this->added_datetime = $added_datetime;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
