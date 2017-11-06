<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entrega
 *
 * @ORM\Table(name="entrega")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EntregaRepository")
 */
class Entrega
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
     * @ORM\Column(name="provincia_entrega", type="string", length=255, nullable=true)
     */
    private $provinciaEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="localidad_entrega", type="string", length=255, nullable=true)
     */
    private $localidadEntrega;


    /**
     * @var string
     *
     * @ORM\Column(name="calle_entrega", type="string", length=255, nullable=true)
     */
    private $calleEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="altura_entrega", type="string", length=255, nullable=true)
     */
    private $alturaEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="piso_entrega", type="string", length=255, nullable=true)
     */
    private $pisoEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="departamento_entrega", type="string", length=255, nullable=true)
     */
    private $departamentoEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_postal_entrega", type="string", length=255, nullable=true)
     */
    private $codigoPostalEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="costo_cliente_entrega", type="string", length=255, nullable=true)
     */
    private $costoClienteEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="costo_nosotros_entrega", type="string", length=255, nullable=true)
     */
    private $costoNosotrosEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_recibe_entrega", type="string", length=255, nullable=true)
     */
    private $nombreRecibeEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="celular_recibe_entrega", type="string", length=255, nullable=true)
     */
    private $celularRecibeEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha_entrega",type="datetime", nullable=true)
     */
    private $fechaEntrega;



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
     * Set provinciaEntrega
     *
     * @param string $provinciaEntrega
     *
     * @return Entrega
     */
    public function setProvinciaEntrega($provinciaEntrega)
    {
        $this->provinciaEntrega = $provinciaEntrega;

        return $this;
    }

    /**
     * Get provinciaEntrega
     *
     * @return string
     */
    public function getProvinciaEntrega()
    {
        return $this->provinciaEntrega;
    }

    /**
     * Set localidadEntrega
     *
     * @param string $localidadEntrega
     *
     * @return Entrega
     */
    public function setLocalidadEntrega($localidadEntrega)
    {
        $this->localidadEntrega = $localidadEntrega;

        return $this;
    }

    /**
     * Get localidadEntrega
     *
     * @return string
     */
    public function getLocalidadEntrega()
    {
        return $this->localidadEntrega;
    }

    /**
     * Set calleEntrega
     *
     * @param string $calleEntrega
     *
     * @return Entrega
     */
    public function setCalleEntrega($calleEntrega)
    {
        $this->calleEntrega = $calleEntrega;

        return $this;
    }

    /**
     * Get calleEntrega
     *
     * @return string
     */
    public function getCalleEntrega()
    {
        return $this->calleEntrega;
    }

    /**
     * Set alturaEntrega
     *
     * @param string $alturaEntrega
     *
     * @return Entrega
     */
    public function setAlturaEntrega($alturaEntrega)
    {
        $this->alturaEntrega = $alturaEntrega;

        return $this;
    }

    /**
     * Get alturaEntrega
     *
     * @return string
     */
    public function getAlturaEntrega()
    {
        return $this->alturaEntrega;
    }

    /**
     * Set pisoEntrega
     *
     * @param string $pisoEntrega
     *
     * @return Entrega
     */
    public function setPisoEntrega($pisoEntrega)
    {
        $this->pisoEntrega = $pisoEntrega;

        return $this;
    }

    /**
     * Get pisoEntrega
     *
     * @return string
     */
    public function getPisoEntrega()
    {
        return $this->pisoEntrega;
    }

    /**
     * Set departamentoEntrega
     *
     * @param string $departamentoEntrega
     *
     * @return Entrega
     */
    public function setDepartamentoEntrega($departamentoEntrega)
    {
        $this->departamentoEntrega = $departamentoEntrega;

        return $this;
    }

    /**
     * Get departamentoEntrega
     *
     * @return string
     */
    public function getDepartamentoEntrega()
    {
        return $this->departamentoEntrega;
    }

    /**
     * Set codigoPostalEntrega
     *
     * @param string $codigoPostalEntrega
     *
     * @return Entrega
     */
    public function setCodigoPostalEntrega($codigoPostalEntrega)
    {
        $this->codigoPostalEntrega = $codigoPostalEntrega;

        return $this;
    }

    /**
     * Get codigoPostalEntrega
     *
     * @return string
     */
    public function getCodigoPostalEntrega()
    {
        return $this->codigoPostalEntrega;
    }

    /**
     * Set costoClienteEntrega
     *
     * @param string $costoClienteEntrega
     *
     * @return Entrega
     */
    public function setCostoClienteEntrega($costoClienteEntrega)
    {
        $this->costoClienteEntrega = $costoClienteEntrega;

        return $this;
    }

    /**
     * Get costoClienteEntrega
     *
     * @return string
     */
    public function getCostoClienteEntrega()
    {
        return $this->costoClienteEntrega;
    }

    /**
     * Set costoNosotrosEntrega
     *
     * @param string $costoNosotrosEntrega
     *
     * @return Entrega
     */
    public function setCostoNosotrosEntrega($costoNosotrosEntrega)
    {
        $this->costoNosotrosEntrega = $costoNosotrosEntrega;

        return $this;
    }

    /**
     * Get costoNosotrosEntrega
     *
     * @return string
     */
    public function getCostoNosotrosEntrega()
    {
        return $this->costoNosotrosEntrega;
    }

    /**
     * Set nombreRecibeEntrega
     *
     * @param string $nombreRecibeEntrega
     *
     * @return Entrega
     */
    public function setNombreRecibeEntrega($nombreRecibeEntrega)
    {
        $this->nombreRecibeEntrega = $nombreRecibeEntrega;

        return $this;
    }

    /**
     * Get nombreRecibeEntrega
     *
     * @return string
     */
    public function getNombreRecibeEntrega()
    {
        return $this->nombreRecibeEntrega;
    }

    /**
     * Set celularRecibeEntrega
     *
     * @param string $celularRecibeEntrega
     *
     * @return Entrega
     */
    public function setCelularRecibeEntrega($celularRecibeEntrega)
    {
        $this->celularRecibeEntrega = $celularRecibeEntrega;

        return $this;
    }

    /**
     * Get celularRecibeEntrega
     *
     * @return string
     */
    public function getCelularRecibeEntrega()
    {
        return $this->celularRecibeEntrega;
    }

    /**
     * Set fechaEntrega
     *
     * @param \DateTime $fechaEntrega
     *
     * @return Entrega
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    /**
     * Get fechaEntrega
     *
     * @return \DateTime
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }
}
