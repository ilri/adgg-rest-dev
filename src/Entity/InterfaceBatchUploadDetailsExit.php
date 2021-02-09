<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceBatchUploadDetailsExit
 *
 * @ORM\Table(name="interface_batch_upload_details_exit")
 * @ORM\Entity
 */
class InterfaceBatchUploadDetailsExit
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
     * @ORM\Column(name="animal_id", type="string", length=250, nullable=true)
     */
    private $animalId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="exit_date", type="string", length=250, nullable=true)
     */
    private $exitDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="disposal_reason", type="string", length=250, nullable=true)
     */
    private $disposalReason;

    /**
     * @var string|null
     *
     * @ORM\Column(name="disposal_amount", type="string", length=250, nullable=true)
     */
    private $disposalAmount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_farmer_name", type="string", length=250, nullable=true)
     */
    private $newFarmerName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_farmer_phone_number", type="string", length=250, nullable=true)
     */
    private $newFarmerPhoneNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_breeder_name", type="string", length=250, nullable=true)
     */
    private $newBreederName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_breeder_phone_number", type="string", length=250, nullable=true)
     */
    private $newBreederPhoneNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_country", type="string", length=250, nullable=true)
     */
    private $newCountry;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_region", type="string", length=250, nullable=true)
     */
    private $newRegion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_district", type="string", length=250, nullable=true)
     */
    private $newDistrict;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_ward", type="string", length=250, nullable=true)
     */
    private $newWard;

    /**
     * @var string|null
     *
     * @ORM\Column(name="new_village", type="string", length=250, nullable=true)
     */
    private $newVillage;

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
