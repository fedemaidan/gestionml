<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaEbay
 *
 * @ORM\Table(name="busqueda_ebay")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BusquedaEbayRepository")
 */
class BusquedaEbay
{
    const ORM_ENTITY = "AppBundle:BusquedaEbay";
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
     * @ORM\Column(name="vendedor_ebay_id", type="string", length=255)
     */
    private $vendedorEbayId;

    /**
     * @var bool
     *
     * @ORM\Column(name="filtrar_new", type="boolean", nullable=true)
     */
    private $filtrarNew;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_minimo", type="string", length=255, nullable=true)
     */
    private $precioMinimo;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_maximo", type="string", length=255, nullable=true)
     */
    private $precioMaximo;

    /**
     * @var string
     *
     * @ORM\Column(name="categoria", type="string", length=255, nullable=true)
     */
    private $categoria;


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
     * Set vendedorEbayId
     *
     * @param string $vendedorEbayId
     *
     * @return BusquedaEbay
     */
    public function setVendedorEbayId($vendedorEbayId)
    {
        $this->vendedorEbayId = $vendedorEbayId;

        return $this;
    }

    /**
     * Get vendedorEbayId
     *
     * @return string
     */
    public function getVendedorEbayId()
    {
        return $this->vendedorEbayId;
    }

    /**
     * Set filtrarNew
     *
     * @param boolean $filtrarNew
     *
     * @return BusquedaEbay
     */
    public function setFiltrarNew($filtrarNew)
    {
        $this->filtrarNew = $filtrarNew;

        return $this;
    }

    /**
     * Get filtrarNew
     *
     * @return bool
     */
    public function getFiltrarNew()
    {
        return $this->filtrarNew;
    }

    /**
     * Set precioMinimo
     *
     * @param string $precioMinimo
     *
     * @return BusquedaEbay
     */
    public function setPrecioMinimo($precioMinimo)
    {
        $this->precioMinimo = $precioMinimo;

        return $this;
    }

    /**
     * Get precioMinimo
     *
     * @return string
     */
    public function getPrecioMinimo()
    {
        return $this->precioMinimo;
    }

    /**
     * Set precioMaximo
     *
     * @param string $precioMaximo
     *
     * @return BusquedaEbay
     */
    public function setPrecioMaximo($precioMaximo)
    {
        $this->precioMaximo = $precioMaximo;

        return $this;
    }

    /**
     * Get precioMaximo
     *
     * @return string
     */
    public function getPrecioMaximo()
    {
        return $this->precioMaximo;
    }

    /**
     * Set categoria
     *
     * @param string $categoria
     *
     * @return BusquedaEbay
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
}

