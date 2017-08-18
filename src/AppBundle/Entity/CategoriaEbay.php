<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriaEbay
 *
 * @ORM\Table(name="categoria_ebay")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriaEbayRepository")
 */
class CategoriaEbay
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="idEbay", type="string", length=255, unique=true)
     */
    private $idEbay;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idEbay
     *
     * @param string $idEbay
     *
     * @return CategoriaEbay
     */
    public function setIdEbay($idEbay)
    {
        $this->idEbay = $idEbay;

        return $this;
    }

    /**
     * Get idEbay
     *
     * @return string
     */
    public function getIdEbay()
    {
        return $this->idEbay;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CategoriaEbay
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

