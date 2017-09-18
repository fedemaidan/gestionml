<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Reserva
 *
 * @ORM\Table(name="reserva")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservaRepository")
 */
class Reserva
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
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $fechaModificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="decimal",  precision=7, scale=2)
     */
    private $precio;

    /**
     * @var string
     *
     * @ORM\Column(name="informacion", type="string", length=2000, nullable=true)
     */
    private $informacion;

    /**
     * @var string
     *
     * @ORM\Column(name="sena", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $sena;

    /**
     * @var string
     *
     * @ORM\Column(name="linkUsados", type="string", length=1000, nullable=true)
     */
    private $linkUsados;

    /**
     * @var string
     *
     * @ORM\Column(name="cliente", type="string", length=1000, nullable=true)
     */
    private $cliente;

    /**
     * @var string
     *
     * @ORM\Column(name="producto_no_cargado", type="string", length=255, nullable=true)
     */
    private $productoNoCargado;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_reserva", type="string", length=255, nullable=true)
     */
    private $codigoReserva;

    /**
     * @var TipoDeVenta
     * @ORM\ManyToOne(targetEntity="TipoDeVenta")
     * @ORM\JoinColumn(nullable=true)
     */
    private $tipoDeVenta;

    /**
     * @var TipoDePago
     * @ORM\ManyToOne(targetEntity="TipoDePago")
     * @ORM\JoinColumn(nullable=true)
     */
    private $tipoDePago;

    /**
     * @var Estado
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(nullable=true)
     */
    private $estado;

    /**
     * @var TipoDeEntrega
     * @ORM\ManyToOne(targetEntity="TipoDeEntrega")
     * @ORM\JoinColumn(nullable=true)
     */
    private $tipoDeEntrega;


    /**
     * @var Cuenta
     * @ORM\ManyToOne(targetEntity="Cuenta")
     * @ORM\JoinColumn(nullable=true)
     */
    private $cuenta;

    /**
     * @var Cuenta
     * @ORM\ManyToOne(targetEntity="Cuenta")
     * @ORM\JoinColumn(nullable=true)
     */
    private $cuentaUsados;

    /**
     * @var Producto
     * @ORM\ManyToOne(targetEntity="Producto")
     * @ORM\JoinColumn(nullable=true)
     */
    private $producto;


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
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     *
     * @return Reserva
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     *
     * @return Reserva
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set precio
     *
     * @param string $precio
     *
     * @return Reserva
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
     * Set informacion
     *
     * @param string $informacion
     *
     * @return Reserva
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
     * Set sena
     *
     * @param string $sena
     *
     * @return Reserva
     */
    public function setSena($sena)
    {
        $this->sena = $sena;

        return $this;
    }

    /**
     * Get sena
     *
     * @return string
     */
    public function getSena()
    {
        return $this->sena;
    }

    /**
     * Set linkUsados
     *
     * @param string $linkUsados
     *
     * @return Reserva
     */
    public function setLinkUsados($linkUsados)
    {
        $this->linkUsados = $linkUsados;

        return $this;
    }

    /**
     * Get linkUsados
     *
     * @return string
     */
    public function getLinkUsados()
    {
        return $this->linkUsados;
    }


    /**
     * Set cliente
     *
     * @param string $cliente
     *
     * @return Reserva
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return string
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set productoNoCargado
     *
     * @param string $productoNoCargado
     *
     * @return Reserva
     */
    public function setProductoNoCargado($productoNoCargado)
    {
        $this->productoNoCargado = $productoNoCargado;

        return $this;
    }

    /**
     * Get productoNoCargado
     *
     * @return string
     */
    public function getProductoNoCargado()
    {
        return $this->productoNoCargado;
    }

    /**
     * Set codigoItem
     *
     * @param string $codigoItem
     *
     * @return Reserva
     */
    public function setCodigoItem($codigoItem)
    {
        $this->codigoItem = $codigoItem;

        return $this;
    }

    /**
     * Get codigoItem
     *
     * @return string
     */
    public function getCodigoItem()
    {
        return $this->codigoItem;
    }

    /**
     * Set tipoDeVenta
     *
     * @param \AppBundle\Entity\TipoDeVenta $tipoDeVenta
     *
     * @return Reserva
     */
    public function setTipoDeVenta(\AppBundle\Entity\TipoDeVenta $tipoDeVenta = null)
    {
        $this->tipoDeVenta = $tipoDeVenta;

        return $this;
    }

    /**
     * Get tipoDeVenta
     *
     * @return \AppBundle\Entity\TipoDeVenta
     */
    public function getTipoDeVenta()
    {
        return $this->tipoDeVenta;
    }

    /**
     * Set tipoDePago
     *
     * @param \AppBundle\Entity\TipoDePago $tipoDePago
     *
     * @return Reserva
     */
    public function setTipoDePago(\AppBundle\Entity\TipoDePago $tipoDePago = null)
    {
        $this->tipoDePago = $tipoDePago;

        return $this;
    }

    /**
     * Get tipoDePago
     *
     * @return \AppBundle\Entity\TipoDePago
     */
    public function getTipoDePago()
    {
        return $this->tipoDePago;
    }

    /**
     * Set estado
     *
     * @param \AppBundle\Entity\Estado $estado
     *
     * @return Reserva
     */
    public function setEstado(\AppBundle\Entity\Estado $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \AppBundle\Entity\Estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set tipoDeEntrega
     *
     * @param \AppBundle\Entity\TipoDeEntrega $tipoDeEntrega
     *
     * @return Reserva
     */
    public function setTipoDeEntrega(\AppBundle\Entity\TipoDeEntrega $tipoDeEntrega = null)
    {
        $this->tipoDeEntrega = $tipoDeEntrega;

        return $this;
    }

    /**
     * Get tipoDeEntrega
     *
     * @return \AppBundle\Entity\TipoDeEntrega
     */
    public function getTipoDeEntrega()
    {
        return $this->tipoDeEntrega;
    }

    /**
     * Set cuenta
     *
     * @param \AppBundle\Entity\Cuenta $cuenta
     *
     * @return Reserva
     */
    public function setCuenta(\AppBundle\Entity\Cuenta $cuenta = null)
    {
        $this->cuenta = $cuenta;

        return $this;
    }

    /**
     * Get cuenta
     *
     * @return \AppBundle\Entity\Cuenta
     */
    public function getCuenta()
    {
        return $this->cuenta;
    }

    /**
     * Set producto
     *
     * @param \AppBundle\Entity\Producto $producto
     *
     * @return Reserva
     */
    public function setProducto(\AppBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return \AppBundle\Entity\Producto
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set codigoReserva
     *
     * @param string $codigoReserva
     *
     * @return Reserva
     */
    public function setCodigoReserva($codigoReserva)
    {
        $this->codigoReserva = $codigoReserva;

        return $this;
    }

    /**
     * Get codigoReserva
     *
     * @return string
     */
    public function getCodigoReserva()
    {
        return $this->codigoReserva;
    }

    /**
     * Set cuentaUsados
     *
     * @param \AppBundle\Entity\Cuenta $cuentaUsados
     *
     * @return Reserva
     */
    public function setCuentaUsados(\AppBundle\Entity\Cuenta $cuentaUsados = null)
    {
        $this->cuentaUsados = $cuentaUsados;

        return $this;
    }

    /**
     * Get cuentaUsados
     *
     * @return \AppBundle\Entity\Cuenta
     */
    public function getCuentaUsados()
    {
        return $this->cuentaUsados;
    }
}
