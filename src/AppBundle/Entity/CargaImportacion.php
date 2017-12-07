<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * CargaImportacion
 *
 * @ORM\Table(name="carga_importacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CargaImportacionRepository")
 */
class CargaImportacion
{

    const ESTADO_GENERADA = "Generada";
    const ESTADO_RECIBIDA = "Recibida";

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
     * @ORM\Column(name="numero_vuelo", type="string", length=255, nullable=true)
     */
    private $numeroVuelo;

    /**
     * @var string
     *
     * @ORM\Column(name="empresa_envio", type="string", length=255, nullable=true)
     */
    private $empresaEnvio;

    /**
     * @var int
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=true)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_estimada_llegada", type="datetime", nullable=true)
     */
    private $fechaEstimadaLlegada;

    /**
     * @var string
     *
     * @ORM\Column(name="informacion", type="string", length=2000, nullable=true)
     */
    private $informacion;

    /**
     * @var Reserva
     * @ORM\OneToMany(targetEntity="Reserva", mappedBy="cargaImportacion")
     */
    private $reservas;

    // Unmapped property used for file upload
    protected $file;


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
     * @param string $estado
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
     * @return string
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

    /**
     * Set numeroVuelo
     *
     * @param string $numeroVuelo
     *
     * @return CargaImportacion
     */
    public function setNumeroVuelo($numeroVuelo)
    {
        $this->numeroVuelo = $numeroVuelo;

        return $this;
    }

    /**
     * Get numeroVuelo
     *
     * @return string
     */
    public function getNumeroVuelo()
    {
        return $this->numeroVuelo;
    }

    /**
     * Set fechaEstimadaLlegada
     *
     * @param \DateTime $fechaEstimadaLlegada
     *
     * @return CargaImportacion
     */
    public function setFechaEstimadaLlegada($fechaEstimadaLlegada)
    {
        $this->fechaEstimadaLlegada = $fechaEstimadaLlegada;

        return $this;
    }

    /**
     * Get fechaEstimadaLlegada
     *
     * @return \DateTime
     */
    public function getFechaEstimadaLlegada()
    {
        return $this->fechaEstimadaLlegada;
    }


     /////////////////FILE/////////////////////////////
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set informacion
     *
     * @param string $informacion
     *
     * @return CargaImportacion
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
}