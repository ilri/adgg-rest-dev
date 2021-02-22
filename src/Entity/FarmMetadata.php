<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
class FarmMetadata
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     *  @Groups({
     *     "farmmetadata:collection:get",
     *     "farmmetadata:collection:post",
     *     "farmmetadata:item:get",
     *     "farmmetadata:item:put",
     *     "farmmetadata:item:patch"
     * })
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     *
     * @Groups({
     *     "farmmetadata:collection:get",
     *     "farmmetadata:collection:post",
     *     "farmmetadata:item:get",
     *     "farmmetadata:item:put",
     *     "farmmetadata:item:patch"
     * })
     */
    private $type;

    /**
     * @var array|null
     *
     * @ORM\Column(name="additional_attributes", type="json", nullable=true)
     *
     * @Groups({
     *     "farmmetadata:collection:get",
     *     "farmmetadata:collection:post",
     *     "farmmetadata:item:get",
     *     "farmmetadata:item:put",
     *     "farmmetadata:item:patch"
     * })
     */
    private $additionalAttributes;

    /**
     * @var int|null
     *
     * @ORM\Column(name="country_id", type="integer", nullable=true)
     *
     * @Groups({
     *     "farmmetadata:collection:get",
     *     "farmmetadata:collection:post",
     *     "farmmetadata:item:get",
     *     "farmmetadata:item:put",
     *     "farmmetadata:item:patch"
     * })
     */
    private $countryId;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @ORM\Version
     *
     * @Groups({
     *     "farmmetadata:collection:get",
     *     "farmmetadata:collection:post",
     *     "farmmetadata:item:get",
     *     "farmmetadata:item:put",
     *     "farmmetadata:item:patch"
     * })
     */
    private $createdAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     *
     * @Groups({
     *     "farmmetadata:collection:get",
     *     "farmmetadata:collection:post",
     *     "farmmetadata:item:get",
     *     "farmmetadata:item:put",
     *     "farmmetadata:item:patch"
     * })
     */
    private $createdBy;

    /**
     * @var string|null
     *
     * @ORM\Column(name="odk_form_uuid", type="string", length=128, nullable=true)
     *
     * @Groups({
     *     "farmmetadata:collection:get",
     *     "farmmetadata:collection:post",
     *     "farmmetadata:item:get",
     *     "farmmetadata:item:put",
     *     "farmmetadata:item:patch"
     * })
     */
    private $odkFormUuid;

    /**
     * @var \CoreFarm
     *
     * @ORM\ManyToOne(targetEntity="Farm")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="farm_id", referencedColumnName="id")
     * })
     *
     * @Groups({
     *     "farmmetadata:collection:get",
     *     "farmmetadata:collection:post",
     *     "farmmetadata:item:get",
     *     "farmmetadata:item:put",
     *     "farmmetadata:item:patch"
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

    public function getAdditionalAttributes(): ?array
    {
        return $this->additionalAttributes;
    }

    public function setAdditionalAttributes(?array $additionalAttributes): self
    {
        $this->additionalAttributes = $additionalAttributes;

        return $this;
    }

    public function getCountryId(): ?int
    {
        return $this->countryId;
    }

    public function setCountryId(?int $countryId): self
    {
        $this->countryId = $countryId;

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

    public function getOdkFormUuid(): ?string
    {
        return $this->odkFormUuid;
    }

    public function setOdkFormUuid(?string $odkFormUuid): self
    {
        $this->odkFormUuid = $odkFormUuid;

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
