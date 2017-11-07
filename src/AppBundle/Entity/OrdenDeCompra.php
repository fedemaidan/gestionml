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
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $fechaAlta;

    /**
     * @var string
     *
     * @ORM\Column(name="proveedor", type="string", length=255, nullable=true)
     */
    private $proveedor;

    /**
     * @var string
     *
     * @ORM\Column(name="cuenta_ebay_compra", type="string", length=255, nullable=true)
     */
    private $cuentaEbayCompra;

    /**
     * @var string
     *
     * @ORM\Column(name="warehouse", type="string", length=255, nullable=true)
     */
    private $warehouse;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping", type="string", length=255, nullable=true)
     */
    private $shipping;


    /**
     * @var string
     *
     * @ORM\Column(name="tarjeta_1", type="string", length=255, nullable=true)
     */
    private $tarjeta1;

    /**
     * @var string
     *
     * @ORM\Column(name="pago_1", type="decimal",  precision=7, scale=2, nullable=true)
     */
    private $pago1;

    /**
     * @var string
     *
     * @ORM\Column(name="tarjeta_2", type="string", length=255, nullable=true)
     */
    private $tarjeta2;

    /**
     * @var string
     *
     * @ORM\Column(name="pago_2", type="decimal",  precision=7, scale=2, nullable=true)
     */
    private $pago2;

    /**
     * @var string
     *
     * @ORM\Column(name="tarjeta_3", type="string", length=255, nullable=true)
     */
    private $tarjeta3;

    /**
     * @var string
     *
     * @ORM\Column(name="pago_3", type="decimal",  precision=7, scale=2, nullable=true)
     */
    private $pago3;

    /**
     * @var string
     *
     * @ORM\Column(name="tarjeta_4", type="string", length=255, nullable=true)
     */
    private $tarjeta4;

    /**
     * @var string
     *
     * @ORM\Column(name="pago_4", type="decimal",  precision=7, scale=2, nullable=true)
     */
    private $pago4;

    /**
     * @var string
     *
     * @ORM\Column(name="tarjeta_5", type="string", length=255, nullable=true)
     */
    private $tarjeta5;

    /**
     * @var string
     *
     * @ORM\Column(name="pago_5", type="decimal",  precision=7, scale=2, nullable=true)
     */
    private $pago5;

    /**
     * @var Reserva
     * @ORM\OneToMany(targetEntity="Reserva", mappedBy="ordenDeCompra")
     */
    private $reservas;

    /**
     * @var string
     *
     * @ORM\Column(name="informacion", type="string", length=610, nullable=true)
     */
    private $informacion;


    
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

    public function costoTotal() {
        $costoTotal = 0;
        foreach ($this->reservas as $reserva) {
            $costoTotal += $reserva->getCostoCompraProducto();
        }
        $costoTotal += $this->shipping;
        return $costoTotal;
    }

    /**
     * Set warehouse
     *
     * @param string $warehouse
     *
     * @return OrdenDeCompra
     */
    public function setWarehouse($warehouse)
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    /**
     * Get warehouse
     *
     * @return string
     */
    public function getWarehouse()
    {
        return $this->warehouse;
    }

    /**
     * Set shipping
     *
     * @param string $shipping
     *
     * @return OrdenDeCompra
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;

        return $this;
    }

    /**
     * Get shipping
     *
     * @return string
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * Set proveedor
     *
     * @param string $proveedor
     *
     * @return OrdenDeCompra
     */
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return string
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set cuentaEbayCompra
     *
     * @param string $cuentaEbayCompra
     *
     * @return OrdenDeCompra
     */
    public function setCuentaEbayCompra($cuentaEbayCompra)
    {
        $this->cuentaEbayCompra = $cuentaEbayCompra;

        return $this;
    }

    /**
     * Get cuentaEbayCompra
     *
     * @return string
     */
    public function getCuentaEbayCompra()
    {
        return $this->cuentaEbayCompra;
    }

    /**
     * Set tarjeta1
     *
     * @param string $tarjeta1
     *
     * @return OrdenDeCompra
     */
    public function setTarjeta1($tarjeta1)
    {
        $this->tarjeta1 = $tarjeta1;

        return $this;
    }

    /**
     * Get tarjeta1
     *
     * @return string
     */
    public function getTarjeta1()
    {
        return $this->tarjeta1;
    }

    /**
     * Set pago1
     *
     * @param string $pago1
     *
     * @return OrdenDeCompra
     */
    public function setPago1($pago1)
    {
        $this->pago1 = $pago1;

        return $this;
    }

    /**
     * Get pago1
     *
     * @return string
     */
    public function getPago1()
    {
        return $this->pago1;
    }

    /**
     * Set tarjeta2
     *
     * @param string $tarjeta2
     *
     * @return OrdenDeCompra
     */
    public function setTarjeta2($tarjeta2)
    {
        $this->tarjeta2 = $tarjeta2;

        return $this;
    }

    /**
     * Get tarjeta2
     *
     * @return string
     */
    public function getTarjeta2()
    {
        return $this->tarjeta2;
    }

    /**
     * Set pago2
     *
     * @param string $pago2
     *
     * @return OrdenDeCompra
     */
    public function setPago2($pago2)
    {
        $this->pago2 = $pago2;

        return $this;
    }

    /**
     * Get pago2
     *
     * @return string
     */
    public function getPago2()
    {
        return $this->pago2;
    }

    /**
     * Set tarjeta3
     *
     * @param string $tarjeta3
     *
     * @return OrdenDeCompra
     */
    public function setTarjeta3($tarjeta3)
    {
        $this->tarjeta3 = $tarjeta3;

        return $this;
    }

    /**
     * Get tarjeta3
     *
     * @return string
     */
    public function getTarjeta3()
    {
        return $this->tarjeta3;
    }

    /**
     * Set pago3
     *
     * @param string $pago3
     *
     * @return OrdenDeCompra
     */
    public function setPago3($pago3)
    {
        $this->pago3 = $pago3;

        return $this;
    }

    /**
     * Get pago3
     *
     * @return string
     */
    public function getPago3()
    {
        return $this->pago3;
    }

    /**
     * Set tarjeta4
     *
     * @param string $tarjeta4
     *
     * @return OrdenDeCompra
     */
    public function setTarjeta4($tarjeta4)
    {
        $this->tarjeta4 = $tarjeta4;

        return $this;
    }

    /**
     * Get tarjeta4
     *
     * @return string
     */
    public function getTarjeta4()
    {
        return $this->tarjeta4;
    }

    /**
     * Set pago4
     *
     * @param string $pago4
     *
     * @return OrdenDeCompra
     */
    public function setPago4($pago4)
    {
        $this->pago4 = $pago4;

        return $this;
    }

    /**
     * Get pago4
     *
     * @return string
     */
    public function getPago4()
    {
        return $this->pago4;
    }

    /**
     * Set tarjeta5
     *
     * @param string $tarjeta5
     *
     * @return OrdenDeCompra
     */
    public function setTarjeta5($tarjeta5)
    {
        $this->tarjeta5 = $tarjeta5;

        return $this;
    }

    /**
     * Get tarjeta5
     *
     * @return string
     */
    public function getTarjeta5()
    {
        return $this->tarjeta5;
    }

    /**
     * Set pago5
     *
     * @param string $pago5
     *
     * @return OrdenDeCompra
     */
    public function setPago5($pago5)
    {
        $this->pago5 = $pago5;

        return $this;
    }

    /**
     * Get pago5
     *
     * @return string
     */
    public function getPago5()
    {
        return $this->pago5;
    }

    public function pagosTotal() {
        return $this->pago1 + $this->pago2 + $this->pago3 + $this->pago4 + $this->pago5 ;
    }
    public function pagosValidosTexto() {
        $valido = $this->pagosValidos();
        if ($valido)
            return "OK";
        else 
            return "Pagos invalidos. ". "Sumatoria de costo = ".$this->costoTotal()." --- Pagos = ".$this->pagosTotal();
    }   

    public function pagosValidos() {
        $pagosRealizados = $this->pagosTotal();
        return intval($pagosRealizados) == intval($this->costoTotal());
    }
}
