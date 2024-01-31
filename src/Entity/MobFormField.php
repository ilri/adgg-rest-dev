<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MobFormFieldRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="mob_form_field")
 * @ORM\Entity(repositoryClass=MobFormFieldRepository::class)
 */
#[ApiResource]
class MobFormField
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="field_id", type="integer")
     */

    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="form_id", type="integer", nullable=true)
     */
    private $form_id;

    /**
     * @var int
     *
     * @ORM\Column(name="attribute_colm", type="integer")
     */
    private $attribute_colm;

    /**
     * @var int|null
     *
     * @ORM\Column(name="attribute_val",type="integer")
     */
    private $attribute_val;

    /**
     * @var int|null
     *
     * @ORM\Column(name="fieldvalue_set", type="integer", nullable=true)
     */
    private $fieldvalue_set;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type",type="string", length=100, nullable=true)
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="required",type="string", length=30, nullable=true)
     */
    private $required;

    /**
     * @var string|null
     *
     * @ORM\Column(name="label",type="string", length=300, nullable=true)
     */
    private $label;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description",type="string", length=300, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name",type="string", length=300, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subtype", type="string", length=100, nullable=true)
     */
    private $subtype;

    /**
     * @var int|null
     *
     * @ORM\Column(name="maxlength", type="integer", nullable=true)
     */
    private $maxlength;

    /**
     * @var float|null
     *
     * @ORM\Column(name="min_val", type="float", nullable=true)
     */
    private $min_val;

    /**
     * @var int|null
     *
     * @ORM\Column(name="max_val",type="bigint", nullable=true)
     */
    private $max_val;

    /**
     * @var string|null
     *
     * @ORM\Column(name="className", type="string", length=100, nullable=true)
     */
    private $className;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inline", type="string", length=30, nullable=true)
     */
    private $inline;

    /**
     * @var string|null
     *
     * @ORM\Column(name="multiple", type="string", length=30, nullable=true)
     */
    private $multiple;

    /**
     * @var string|null
     *
     * @ORM\Column(name="parent_id", type="string", length=100, nullable=true)
     */
    private $parent_id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="parent_relation", type="string", length=255, nullable=true)
     */
    private $parent_relation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="parent_value", type="string", length=255, nullable=true)
     */
    private $parent_value;

    /**
     * @var string|null
     *
     * @ORM\Column(name="parent_multiple_value", type="string", length=255, nullable=true)
     */
    private $parent_multiple_value;

    /**
     * @var string|null
     *
     * @ORM\Column(name="child_id", type="string", length=255)
     */
    private $child_id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="field_count", type="integer", nullable=true)
     */
    private $field_count;

    /**
     * @var int|null
     *
     * @ORM\Column(name="slno", type="integer", nullable=true)
     */
    private $slno;

    /**
     * @var int|null
     *
     * @ORM\Column(name="filter", type="integer", nullable=true)
     */
    private $filter;

    /**
     * @var int|null
     *
     * @ORM\Column(name="added_by", type="integer", nullable=true)
     */
    private $added_by;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_datetime", type="datetime")
     */
    private $added_datetime;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ip_address", type="string", length=100, nullable=true)
     */
    private $ip_address;

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

    public function getFormId(): ?int
    {
        return $this->form_id;
    }

    public function setFormId(?int $form_id): self
    {
        $this->form_id = $form_id;

        return $this;
    }

    public function getAttributeColm(): ?int
    {
        return $this->attribute_colm;
    }

    public function setAttributeColm(int $attribute_colm): self
    {
        $this->attribute_colm = $attribute_colm;

        return $this;
    }

    public function getAttributeVal(): ?int
    {
        return $this->attribute_val;
    }

    public function setAttributeVal(int $attribute_val): self
    {
        $this->attribute_val = $attribute_val;

        return $this;
    }

    public function getFieldvalueSet(): ?int
    {
        return $this->fieldvalue_set;
    }

    public function setFieldvalueSet(?int $fieldvalue_set): self
    {
        $this->fieldvalue_set = $fieldvalue_set;

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

    public function getRequired(): ?string
    {
        return $this->required;
    }

    public function setRequired(?string $required): self
    {
        $this->required = $required;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSubtype(): ?string
    {
        return $this->subtype;
    }

    public function setSubtype(?string $subtype): self
    {
        $this->subtype = $subtype;

        return $this;
    }

    public function getMaxlength(): ?int
    {
        return $this->maxlength;
    }

    public function setMaxlength(?int $maxlength): self
    {
        $this->maxlength = $maxlength;

        return $this;
    }

    public function getMinVal(): ?float
    {
        return $this->min_val;
    }

    public function setMinVal(?float $min_val): self
    {
        $this->min_val = $min_val;

        return $this;
    }

    public function getMaxVal(): ?string
    {
        return $this->max_val;
    }

    public function setMaxVal(?string $max_val): self
    {
        $this->max_val = $max_val;

        return $this;
    }

    public function getClassName(): ?string
    {
        return $this->className;
    }

    public function setClassName(?string $className): self
    {
        $this->className = $className;

        return $this;
    }

    public function getInline(): ?string
    {
        return $this->inline;
    }

    public function setInline(?string $inline): self
    {
        $this->inline = $inline;

        return $this;
    }

    public function getMultiple(): ?string
    {
        return $this->multiple;
    }

    public function setMultiple(?string $multiple): self
    {
        $this->multiple = $multiple;

        return $this;
    }

    public function getParentId(): ?string
    {
        return $this->parent_id;
    }

    public function setParentId(?string $parent_id): self
    {
        $this->parent_id = $parent_id;

        return $this;
    }

    public function getParentRelation(): ?string
    {
        return $this->parent_relation;
    }

    public function setParentRelation(?string $parent_relation): self
    {
        $this->parent_relation = $parent_relation;

        return $this;
    }

    public function getParentValue(): ?string
    {
        return $this->parent_value;
    }

    public function setParentValue(?string $parent_value): self
    {
        $this->parent_value = $parent_value;

        return $this;
    }

    public function getParentMultipleValue(): ?string
    {
        return $this->parent_multiple_value;
    }

    public function setParentMultipleValue(?string $parent_multiple_value): self
    {
        $this->parent_multiple_value = $parent_multiple_value;

        return $this;
    }

    public function getChildId(): ?string
    {
        return $this->child_id;
    }

    public function setChildId(string $child_id): self
    {
        $this->child_id = $child_id;

        return $this;
    }

    public function getFieldCount(): ?int
    {
        return $this->field_count;
    }

    public function setFieldCount(?int $field_count): self
    {
        $this->field_count = $field_count;

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

    public function getFilter(): ?int
    {
        return $this->filter;
    }

    public function setFilter(?int $filter): self
    {
        $this->filter = $filter;

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

    public function setAddedDatetime(\DateTimeInterface $added_datetime): self
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
