<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceBatchUploadDetailsAnimal
 *
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


}
