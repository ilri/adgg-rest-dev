<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthResources
 *
 * @ORM\Table(name="auth_resources")
 * @ORM\Entity
 */
class AuthResources
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=30, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="viewable", type="boolean", nullable=false, options={"default"="1"})
     */
    private $viewable = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="creatable", type="boolean", nullable=false, options={"default"="1"})
     */
    private $creatable = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="editable", type="boolean", nullable=false, options={"default"="1"})
     */
    private $editable = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="deletable", type="boolean", nullable=false, options={"default"="1"})
     */
    private $deletable = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="executable", type="boolean", nullable=false)
     */
    private $executable = '0';


}
