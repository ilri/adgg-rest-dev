<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait OrganisationTrait
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="org_id", type="integer", nullable=true)
     */
    protected $orgId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="client_id", type="integer", nullable=true)
     */
    protected $clientId;

    public function getOrgId(): ?int
    {
        return $this->orgId;
    }

    public function setOrgId(?int $orgId): self
    {
        $this->orgId = $orgId;

        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function setClientId(?int $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }
}
