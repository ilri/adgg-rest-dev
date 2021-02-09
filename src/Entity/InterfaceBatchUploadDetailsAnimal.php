<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceBatchUploadDetailsAnimal
 *
 * @ApiResource()
 * @ORM\Table(name="interface_batch_upload_details_animal")
 * @ORM\Entity
 */
class InterfaceBatchUploadDetailsAnimal
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
     * @ORM\Column(name="uuid", type="string", length=250, nullable=true)
     */
    private $uuid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tag_id", type="string", length=250, nullable=true)
     */
    private $tagId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="animal_type", type="string", length=250, nullable=true)
     */
    private $animalType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dob", type="string", length=250, nullable=true)
     */
    private $dob;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sex", type="string", length=250, nullable=true)
     */
    private $sex;

    /**
     * @var string|null
     *
     * @ORM\Column(name="color", type="string", length=250, nullable=true)
     */
    private $color;

    /**
     * @var string|null
     *
     * @ORM\Column(name="main_breed", type="string", length=250, nullable=true)
     */
    private $mainBreed;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sec_breed", type="string", length=250, nullable=true)
     */
    private $secBreed;

    /**
     * @var string|null
     *
     * @ORM\Column(name="breed_composition", type="string", length=250, nullable=true)
     */
    private $breedComposition;

    /**
     * @var string|null
     *
     * @ORM\Column(name="entry_type", type="string", length=250, nullable=true)
     */
    private $entryType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sire_type", type="string", length=250, nullable=true)
     */
    private $sireType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sire", type="string", length=250, nullable=true)
     */
    private $sire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dam", type="string", length=250, nullable=true)
     */
    private $dam;

    /**
     * @var int|null
     *
     * @ORM\Column(name="status", type="integer", nullable=true, options={"default"="1"})
     */
    private $status = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="notes", type="string", length=250, nullable=true)
     */
    private $notes;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTagId(): ?string
    {
        return $this->tagId;
    }

    public function setTagId(?string $tagId): self
    {
        $this->tagId = $tagId;

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

    public function getAnimalType(): ?string
    {
        return $this->animalType;
    }

    public function setAnimalType(?string $animalType): self
    {
        $this->animalType = $animalType;

        return $this;
    }

    public function getDob(): ?string
    {
        return $this->dob;
    }

    public function setDob(?string $dob): self
    {
        $this->dob = $dob;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getMainBreed(): ?string
    {
        return $this->mainBreed;
    }

    public function setMainBreed(?string $mainBreed): self
    {
        $this->mainBreed = $mainBreed;

        return $this;
    }

    public function getSecBreed(): ?string
    {
        return $this->secBreed;
    }

    public function setSecBreed(?string $secBreed): self
    {
        $this->secBreed = $secBreed;

        return $this;
    }

    public function getBreedComposition(): ?string
    {
        return $this->breedComposition;
    }

    public function setBreedComposition(?string $breedComposition): self
    {
        $this->breedComposition = $breedComposition;

        return $this;
    }

    public function getEntryType(): ?string
    {
        return $this->entryType;
    }

    public function setEntryType(?string $entryType): self
    {
        $this->entryType = $entryType;

        return $this;
    }

    public function getSireType(): ?string
    {
        return $this->sireType;
    }

    public function setSireType(?string $sireType): self
    {
        $this->sireType = $sireType;

        return $this;
    }

    public function getSire(): ?string
    {
        return $this->sire;
    }

    public function setSire(?string $sire): self
    {
        $this->sire = $sire;

        return $this;
    }

    public function getDam(): ?string
    {
        return $this->dam;
    }

    public function setDam(?string $dam): self
    {
        $this->dam = $dam;

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

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }


}
