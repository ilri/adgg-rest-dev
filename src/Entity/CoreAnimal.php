<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreAnimal
 *
 * @ORM\Table(name="core_animal", indexes={@ORM\Index(name="animal_type", columns={"animal_type"}), @ORM\Index(name="country_id", columns={"country_id", "region_id", "district_id", "ward_id", "village_id"}), @ORM\Index(name="dam_id", columns={"dam_id"}), @ORM\Index(name="farm_id", columns={"farm_id"}), @ORM\Index(name="org_id", columns={"org_id", "client_id"}), @ORM\Index(name="reg_date", columns={"reg_date"}), @ORM\Index(name="sire_id", columns={"sire_id"}), @ORM\Index(name="tag_id", columns={"tag_id"})})
 * @ORM\Entity
 */
class CoreAnimal
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
     * @ORM\Column(name="name", type="string", length=128, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tag_id", type="string", length=128, nullable=true)
     */
    private $tagId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="herd_id", type="integer", nullable=true)
     */
    private $herdId;

    /**
     * @var int
     *
     * @ORM\Column(name="country_id", type="integer", nullable=false)
     */
    private $countryId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="region_id", type="integer", nullable=true)
     */
    private $regionId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="district_id", type="integer", nullable=true)
     */
    private $districtId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ward_id", type="integer", nullable=true)
     */
    private $wardId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="village_id", type="integer", nullable=true)
     */
    private $villageId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="org_id", type="integer", nullable=true)
     */
    private $orgId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="client_id", type="integer", nullable=true)
     */
    private $clientId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="animal_type", type="integer", nullable=true)
     */
    private $animalType;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sex", type="integer", nullable=true)
     */
    private $sex;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="birthdate", type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sire_type", type="integer", nullable=true)
     */
    private $sireType;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sire_id", type="integer", nullable=true)
     */
    private $sireId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sire_tag_id", type="string", length=128, nullable=true)
     */
    private $sireTagId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="dam_id", type="integer", nullable=true)
     */
    private $damId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dam_tag_id", type="string", length=128, nullable=true)
     */
    private $damTagId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="main_breed", type="integer", nullable=true)
     */
    private $mainBreed;

    /**
     * @var int|null
     *
     * @ORM\Column(name="breed_composition", type="integer", nullable=true)
     */
    private $breedComposition;

    /**
     * @var string|null
     *
     * @ORM\Column(name="animal_photo", type="string", length=255, nullable=true)
     */
    private $animalPhoto;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latitude", type="decimal", precision=13, scale=8, nullable=true)
     */
    private $latitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="longitude", type="decimal", precision=13, scale=8, nullable=true)
     */
    private $longitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="map_address", type="string", length=255, nullable=true)
     */
    private $mapAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latlng", type="string", length=0, nullable=true)
     */
    private $latlng;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=255, nullable=false)
     */
    private $uuid;

    /**
     * @var json|null
     *
     * @ORM\Column(name="additional_attributes", type="json", nullable=true)
     */
    private $additionalAttributes;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="reg_date", type="date", nullable=true)
     */
    private $regDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hair_sample_id", type="string", length=128, nullable=true)
     */
    private $hairSampleId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

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

    /**
     * @var string|null
     *
     * @ORM\Column(name="migration_id", type="string", length=255, nullable=true, options={"comment"="This is the migrationSouce plus primary key from migration source table of the record e.g KLBA_001"})
     */
    private $migrationId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="odk_form_uuid", type="string", length=128, nullable=true)
     */
    private $odkFormUuid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="odk_animal_code", type="string", length=30, nullable=true, options={"comment"="Animal code from Harrison db for odk form versions 1.5 and below "})
     */
    private $odkAnimalCode;

    /**
     * @var \CoreFarm
     *
     * @ORM\ManyToOne(targetEntity="CoreFarm")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="farm_id", referencedColumnName="id")
     * })
     */
    private $farm;


}
