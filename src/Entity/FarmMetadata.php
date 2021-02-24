<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * FarmMetadata
 *
 * @ApiResource(
 *     collectionOperations={
 *         "get"={
 *             "method"="GET",
 *             "path"="/farm_metadata",
 *             "normalization_context"={
 *                 "groups"={
 *                      "farmmetadata:collection:get"
 *                 }
 *             }
 *         },
 *         "post"={
 *             "method"="POST",
 *             "path"="/farm_metadata",
 *             "normalization_context"={
 *                 "groups"={
 *                      "farmmetadata:collection:post"
 *                 }
 *             }
 *         },
 *     },
 *     itemOperations={
 *         "get"={
 *             "method"="GET",
 *             "path"="/farm_metadata/{id}",
 *             "normalization_context"={
 *                 "groups"={
 *                      "farmmetadata:item:get"
 *                 }
 *             }
 *         },
 *         "put"={
 *             "method"="PUT",
 *             "path"="/farm_metadata/{id}",
 *             "normalization_context"={
 *                 "groups"={
 *                      "farmmetadata:item:put"
 *                 }
 *             }
 *         },
 *         "patch"={
 *             "method"="PATCH",
 *             "path"="/farm_metadata/{id}",
 *             "normalization_context"={
 *                 "groups"={
 *                      "farmmetadata:item:patch"
 *                 }
 *             }
 *         }
 *     }
 * )
 * @ORM\Table(name="core_farm_metadata", indexes={@ORM\Index(name="country_id", columns={"country_id"}), @ORM\Index(name="farm_id", columns={"farm_id"}), @ORM\Index(name="type", columns={"type"})})
 * @ORM\Entity
 */
class FarmMetadata extends ADGGResource
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
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type;

    /**
     * @var Farm
     *
     * @ORM\ManyToOne(targetEntity="Farm")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="farm_id", referencedColumnName="id")
     * })
     */
    private $farm;

    public function __construct()
    {
        $parent = new ADGGResource();
        unset($parent->regionId);
        unset($parent->districtId);
        unset($parent->wardId);
        unset($parent->villageId);
        unset($parent->orgId);
        unset($parent->clientId);
    }

    public function __set($name, $value)
    {
        $deleted = ['regionId', 'districtId', 'wardId', 'villageId', 'orgId', 'clientId'];
        if (in_array($name, $deleted)) {
            dump($value);
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getFarm(): ?Farm
    {
        return $this->farm;
    }

    public function setFarm(?Farm $farm): self
    {
        $this->farm = $farm;

        return $this;
    }
}
