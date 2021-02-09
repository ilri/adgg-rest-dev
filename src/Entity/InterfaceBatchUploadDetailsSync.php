<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterfaceBatchUploadDetailsSync
 *
 * @ORM\Table(name="interface_batch_upload_details_sync")
 * @ORM\Entity
 */
class InterfaceBatchUploadDetailsSync
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
     * @ORM\Column(name="sync_date", type="string", length=250, nullable=true)
     */
    private $syncDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sync_number", type="string", length=250, nullable=true)
     */
    private $syncNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hormone_type", type="string", length=250, nullable=true)
     */
    private $hormoneType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hormone_source", type="string", length=250, nullable=true)
     */
    private $hormoneSource;

    /**
     * @var string|null
     *
     * @ORM\Column(name="animal_parity", type="string", length=250, nullable=true)
     */
    private $animalParity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hormone_admin", type="string", length=250, nullable=true)
     */
    private $hormoneAdmin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="admin_name", type="string", length=250, nullable=true)
     */
    private $adminName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="admin_phone", type="string", length=250, nullable=true)
     */
    private $adminPhone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cost", type="string", length=250, nullable=true)
     */
    private $cost;

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
