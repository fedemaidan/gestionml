<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * OrdenDeCompra
 *
 * @ORM\Table(name="orden_de_compra")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrdenDeCompraRepository")
 */
class OrdenDeCompra
{

    public function __construct()
    {
        $this->reservas = new ArrayCollection();
    }

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
     * @ORM\Column(name="precio", type="decimal", precision=10, scale=2)
     */
    private $precio;

    /**
     * @var string
     *
     * @ORM\Column(name="tarjetas", type="string", length=255)
     */
    private $tarjetas;

    /**
     * @var string
     *
     * @ORM\Column(name="informacion", type="string", length=610, nullable=true)
     */
    private $informacion;

    /**
     * @var SeleccionDeCompra
     * @ORM\ManyToOne(targetEntity="SeleccionDeCompra")
     * @ORM\JoinColumn(nullable=true)
     */
    private $seleccionDeCompra;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $fechaAlta;

    /**
     * @var string
     *
     * @ORM\Column(name="vendedor_ebay_id", type="string", length=255, nullable=true)
     */
    private $vendedorEbayId;

    /**
     * @var Reserva
     * @ORM\OneToMany(targetEntity="Reserva", mappedBy="ordenDeCompra")
     */
    private $reservas;
    
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
     * Set precio
     *
     * @param string $precio
     *
     * @return OrdenDeCompra
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set tarjetas
     *
     * @param string $tarjetas
     *
     * @return OrdenDeCompra
     */
    public function setTarjetas($tarjetas)
    {
        $this->tarjetas = $tarjetas;

        return $this;
    }

    /**
     * Get tarjetas
     *
     * @return string
     */
    public function getTarjetas()
    {
        return $this->tarjetas;
    }

    /**
     * Set informacion
     *
     * @param string $informacion
     *
     * @return OrdenDeCompra
     */
    public function setInformacion($informacion)
    {
        $this->informacion = $informacion;

        return $this;
    }

    /**
     * Get informacion
     *
     * @return string
     */
    public function getInformacion()
    {
        return $this->informacion;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return OrdenDeCompra
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set vendedorEbayId
     *
     * @param string $vendedorEbayId
     *
     * @return OrdenDeCompra
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
     * Set seleccionDeCompra
     *
     * @param \AppBundle\Entity\SeleccionDeCompra $seleccionDeCompra
     *
     * @return OrdenDeCompra
     */
    public function setSeleccionDeCompra(\AppBundle\Entity\SeleccionDeCompra $seleccionDeCompra = null)
    {
        $this->seleccionDeCompra = $seleccionDeCompra;

        return $this;
    }

    /**
     * Get seleccionDeCompra
     *
     * @return \AppBundle\Entity\SeleccionDeCompra
     */
    public function getSeleccionDeCompra()
    {
        return $this->seleccionDeCompra;
    }

    /**
     * Add reserva
     *
     * @param \AppBundle\Entity\Reserva $reserva
     *
     * @return OrdenDeCompra
     */
    public function addReserva(\AppBundle\Entity\Reserva $reserva)
    {
        $this->reservas[] = $reserva;

        return $this;
    }

    /**
     * Remove reserva
     *
     * @param \AppBundle\Entity\Reserva $reserva
     */
    public function removeReserva(\AppBundle\Entity\Reserva $reserva)
    {
        $this->reservas->removeElement($reserva);
    }

    /**
     * Get reservas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservas()
    {
        return $this->reservas;
    }
}
