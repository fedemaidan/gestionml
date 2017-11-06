<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * CargaImportacion
 *
 * @ORM\Table(name="carga_importacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CargaImportacionRepository")
 */
class CargaImportacion
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
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="empresa_envio", type="string", length=255, nullable=true)
     */
    private $empresaEnvio;

    /**
     * @var int
     *
     * @ORM\Column(name="estado", type="integer")
     */
    private $estado;

    /**
     * @var Reserva
     * @ORM\OneToMany(targetEntity="Reserva", mappedBy="cargaImportacion")
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
     * Set numero
     *
     * @param string $numero
     *
     * @return CargaImportacion
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set empresaEnvio
     *
     * @param string $empresaEnvio
     *
     * @return CargaImportacion
     */
    public function setEmpresaEnvio($empresaEnvio)
    {
        $this->empresaEnvio = $empresaEnvio;

        return $this;
    }

    /**
     * Get empresaEnvio
     *
     * @return string
     */
    public function getEmpresaEnvio()
    {
        return $this->empresaEnvio;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return CargaImportacion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return int
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Add reserva
     *
     * @param \AppBundle\Entity\Reserva $reserva
     *
     * @return CargaImportacion
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
