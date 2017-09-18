<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table(name="cliente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClienteRepository")
 */
class Cliente
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
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=true, unique=true)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true, unique=true)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_alternativo", type="string", length=255, nullable=true)
     */
    private $telefonoAlternativo;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=2000, nullable=true)
     */
    private $observaciones;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Cliente
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Cliente
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return Cliente
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Cliente
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set telefonoAlternativo
     *
     * @param string $telefonoAlternativo
     *
     * @return Cliente
     */
    public function setTelefonoAlternativo($telefonoAlternativo)
    {
        $this->telefonoAlternativo = $telefonoAlternativo;

        return $this;
    }

    /**
     * Get telefonoAlternativo
     *
     * @return string
     */
    public function getTelefonoAlternativo()
    {
        return $this->telefonoAlternativo;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Cliente
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    public function __toString() {
        return $this->getNombre();
    }
}
