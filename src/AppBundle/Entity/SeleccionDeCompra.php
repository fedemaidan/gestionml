<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * SeleccionDeCompra
 *
 * @ORM\Table(name="seleccion_de_compra")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SeleccionDeCompraRepository")
 */
class SeleccionDeCompra
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
     * @ORM\Column(name="limiteDinero", type="decimal", precision=10, scale=2)
     */
    private $limiteDinero;

    /**
     * @var string
     *
     * @ORM\Column(name="informacion", type="string", length=610, nullable=true)
     */
    private $informacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $fechaAlta;

    /**
     * @var Reserva
     * @ORM\OneToMany(targetEntity="Reserva", mappedBy="seleccionDeCompra")
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
     * Set limiteDinero
     *
     * @param string $limiteDinero
     *
     * @return SeleccionDeCompra
     */
    public function setLimiteDinero($limiteDinero)
    {
        $this->limiteDinero = $limiteDinero;

        return $this;
    }

    /**
     * Get limiteDinero
     *
     * @return string
     */
    public function getLimiteDinero()
    {
        return $this->limiteDinero;
    }

    /**
     * Set informacion
     *
     * @param string $informacion
     *
     * @return SeleccionDeCompra
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
     * @return SeleccionDeCompra
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
     * Add reserva
     *
     * @param \AppBundle\Entity\Reserva $reserva
     *
     * @return SeleccionDeCompra
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