<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(name="valor_pago_1", type="decimal",  precision=7, scale=2, nullable=true)
     */
    private $valorPago1;


    /**
     * @var string
     *
     * @ORM\Column(name="valor_pago_2", type="decimal",  precision=7, scale=2, nullable=true)
     */
    private $valorPago2;


    /**
     * @var string
     *
     * @ORM\Column(name="valor_pago_3", type="decimal",  precision=7, scale=2, nullable=true)
     */
    private $valorPago3;


    /**
     * @var string
     *
     * @ORM\Column(name="valor_pago_4", type="decimal",  precision=7, scale=2, nullable=true)
     */
    private $valorPago4;


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
     * @ORM\Column(name="datos_cliente", type="string", length=1000, nullable=true)
     */
    private $datosCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_cliente", type="string", length=255, nullable=true)
     */
    private $mailCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_cliente", type="string", length=255, nullable=true)
     */
    private $facebookCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_cliente", type="string", length=255, nullable=true)
     */
    private $telefonoCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="producto_no_cargado", type="string", length=255, nullable=true)
     */
    private $productoNoCargado;

    /**
     * @var string
     *
     * @ORM\Column(name="moneda", type="string", length=255, nullable=true)
     * @Assert\Choice({"PESOS", "DOLARES"})
     */
    private $moneda;

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
    private $tipoDePago_1;

    /**
     * @var TipoDePago
     * @ORM\ManyToOne(targetEntity="TipoDePago")
     * @ORM\JoinColumn(nullable=true)
     */
    private $tipoDePago_2;

    /**
     * @var TipoDePago
     * @ORM\ManyToOne(targetEntity="TipoDePago")
     * @ORM\JoinColumn(nullable=true)
     */
    private $tipoDePago_3;

    /**
     * @var TipoDePago
     * @ORM\ManyToOne(targetEntity="TipoDePago")
     * @ORM\JoinColumn(nullable=true)
     */
    private $tipoDePago_4;

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
    private $cuentaPrincipal;

    /**
     * @var Cuenta
     * @ORM\ManyToOne(targetEntity="Cuenta")
     * @ORM\JoinColumn(nullable=true)
     */
    private $cuentaPago;

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

    /**
     * Set moneda
     *
     * @param string $moneda
     *
     * @return Reserva
     */
    public function setMoneda($moneda = "PESO")
    {
        $this->moneda = $moneda;

        return $this;
    }

    /**
     * Get moneda
     *
     * @return string
     */
    public function getMoneda()
    {
        return $this->moneda;
    }

    /**
     * Set tipoDePago2
     *
     * @param \AppBundle\Entity\TipoDePago $tipoDePago2
     *
     * @return Reserva
     */
    public function setTipoDePago2(\AppBundle\Entity\TipoDePago $tipoDePago2 = null)
    {
        $this->tipoDePago_2 = $tipoDePago2;

        return $this;
    }

    /**
     * Get tipoDePago2
     *
     * @return \AppBundle\Entity\TipoDePago
     */
    public function getTipoDePago2()
    {
        return $this->tipoDePago_2;
    }

    /**
     * Set tipoDePago3
     *
     * @param \AppBundle\Entity\TipoDePago $tipoDePago3
     *
     * @return Reserva
     */
    public function setTipoDePago3(\AppBundle\Entity\TipoDePago $tipoDePago3 = null)
    {
        $this->tipoDePago_3 = $tipoDePago3;

        return $this;
    }

    /**
     * Get tipoDePago3
     *
     * @return \AppBundle\Entity\TipoDePago
     */
    public function getTipoDePago3()
    {
        return $this->tipoDePago_3;
    }

    /**
     * Set datosCliente
     *
     * @param string $datosCliente
     *
     * @return Reserva
     */
    public function setDatosCliente($datosCliente)
    {
        $this->datosCliente = $datosCliente;

        return $this;
    }

    /**
     * Get datosCliente
     *
     * @return string
     */
    public function getDatosCliente()
    {
        return $this->datosCliente;
    }

    /**
     * Set mailCliente
     *
     * @param string $mail|
     *
     * @return Reserva
     */
    public function setMailCliente($mailCliente)
    {
        $this->mailCliente = $mailCliente;

        return $this;
    }

    /**
     * Get mailCliente
     *
     * @return string
     */
    public function getMailCliente()
    {
        return $this->mailCliente;
    }

    /**
     * Set facebookCliente
     *
     * @param string $facebookCliente
     *
     * @return Reserva
     */
    public function setFacebookCliente($facebookCliente)
    {
        $this->facebookCliente = $facebookCliente;

        return $this;
    }

    /**
     * Get facebookCliente
     *
     * @return string
     */
    public function getFacebookCliente()
    {
        return $this->facebookCliente;
    }

    /**
     * Set telefonoCliente
     *
     * @param string $telefonoCliente
     *
     * @return Reserva
     */
    public function setTelefonoCliente($telefonoCliente)
    {
        $this->telefonoCliente = $telefonoCliente;

        return $this;
    }

    /**
     * Get telefonoCliente
     *
     * @return string
     */
    public function getTelefonoCliente()
    {
        return $this->telefonoCliente;
    }

    /**
     * Set cuentaIngreso
     *
     * @param \AppBundle\Entity\Cuenta $cuentaIngreso
     *
     * @return Reserva
     */
    public function setCuentaIngreso(\AppBundle\Entity\Cuenta $cuentaIngreso = null)
    {
        $this->cuentaIngreso = $cuentaIngreso;

        return $this;
    }

    /**
     * Get cuentaIngreso
     *
     * @return \AppBundle\Entity\Cuenta
     */
    public function getCuentaIngreso()
    {
        return $this->cuentaIngreso;
    }

    /**
     * Set cuentaPago
     *
     * @param \AppBundle\Entity\Cuenta $cuentaPago
     *
     * @return Reserva
     */
    public function setCuentaPago(\AppBundle\Entity\Cuenta $cuentaPago = null)
    {
        $this->cuentaPago = $cuentaPago;

        return $this;
    }

    /**
     * Get cuentaPago
     *
     * @return \AppBundle\Entity\Cuenta
     */
    public function getCuentaPago()
    {
        return $this->cuentaPago;
    }

    /**
     * Set cuentaPrincipal
     *
     * @param \AppBundle\Entity\Cuenta $cuentaPrincipal
     *
     * @return Reserva
     */
    public function setCuentaPrincipal(\AppBundle\Entity\Cuenta $cuentaPrincipal = null)
    {
        $this->cuentaPrincipal = $cuentaPrincipal;

        return $this;
    }

    /**
     * Get cuentaPrincipal
     *
     * @return \AppBundle\Entity\Cuenta
     */
    public function getCuentaPrincipal()
    {
        return $this->cuentaPrincipal;
    }

    /**
     * Set valorPago1
     *
     * @param string $valorPago1
     *
     * @return Reserva
     */
    public function setValorPago1($valorPago1)
    {
        $this->valorPago1 = $valorPago1;

        return $this;
    }

    /**
     * Get valorPago1
     *
     * @return string
     */
    public function getValorPago1()
    {
        return $this->valorPago1;
    }

    /**
     * Set valorPago2
     *
     * @param string $valorPago2
     *
     * @return Reserva
     */
    public function setValorPago2($valorPago2)
    {
        $this->valorPago2 = $valorPago2;

        return $this;
    }

    /**
     * Get valorPago2
     *
     * @return string
     */
    public function getValorPago2()
    {
        return $this->valorPago2;
    }

    /**
     * Set valorPago3
     *
     * @param string $valorPago3
     *
     * @return Reserva
     */
    public function setValorPago3($valorPago3)
    {
        $this->valorPago3 = $valorPago3;

        return $this;
    }

    /**
     * Get valorPago3
     *
     * @return string
     */
    public function getValorPago3()
    {
        return $this->valorPago3;
    }

    /**
     * Set valorPago4
     *
     * @param string $valorPago4
     *
     * @return Reserva
     */
    public function setValorPago4($valorPago4)
    {
        $this->valorPago4 = $valorPago4;

        return $this;
    }

    /**
     * Get valorPago4
     *
     * @return string
     */
    public function getValorPago4()
    {
        return $this->valorPago4;
    }

    /**
     * Set tipoDePago1
     *
     * @param \AppBundle\Entity\TipoDePago $tipoDePago1
     *
     * @return Reserva
     */
    public function setTipoDePago1(\AppBundle\Entity\TipoDePago $tipoDePago1 = null)
    {
        $this->tipoDePago_1 = $tipoDePago1;

        return $this;
    }

    /**
     * Get tipoDePago1
     *
     * @return \AppBundle\Entity\TipoDePago
     */
    public function getTipoDePago1()
    {
        return $this->tipoDePago_1;
    }

    /**
     * Set tipoDePago4
     *
     * @param \AppBundle\Entity\TipoDePago $tipoDePago4
     *
     * @return Reserva
     */
    public function setTipoDePago4(\AppBundle\Entity\TipoDePago $tipoDePago4 = null)
    {
        $this->tipoDePago_4 = $tipoDePago4;

        return $this;
    }

    /**
     * Get tipoDePago4
     *
     * @return \AppBundle\Entity\TipoDePago
     */
    public function getTipoDePago4()
    {
        return $this->tipoDePago_4;
    }
}