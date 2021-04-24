<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use App\Entity\Traits\{
    CountryTrait,
    IdentifiableTrait
};
use App\Filter\CountryISOCodeFilter;
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
 *             "denormalization_context"={
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
 *             "denormalization_context"={
 *                 "groups"={
 *                      "farmmetadata:item:put"
 *                 }
 *             }
 *         },
 *         "patch"={
 *             "method"="PATCH",
 *             "path"="/farm_metadata/{id}",
 *             "denormalization_context"={
 *                 "groups"={
 *                      "farmmetadata:item:patch"
 *                 }
 *             }
 *         }
 *     }
 * )
 * @ApiFilter(
 *     CountryISOCodeFilter::class
 * )
 * @ORM\Table(name="core_farm_metadata", indexes={@ORM\Index(name="country_id", columns={"country_id"}), @ORM\Index(name="farm_id", columns={"farm_id"}), @ORM\Index(name="type", columns={"type"})})
 * @ORM\Entity
 */
class FarmMetadata
{
    use IdentifiableTrait;
    use CountryTrait;

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
