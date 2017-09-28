<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoDeEntrega
 *
 * @ORM\Table(name="tipo_de_entrega")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TipoDeEntregaRepository")
 */
class TipoDeEntrega
{

    const ORM_ENTITY = "AppBundle:TipoDeEntrega";
    const RETIRO = "RETIRO";
    const REMIS_CON_CARGO = "REMIS_CON_CARGO";
    const REMIS_SIN_CARGO = "REMIS_SIN_CARGO";
    const ETIQUETA_OCA = "ETIQUETA_OCA";
    const ENVIOS_OCA = "ENVIOS_OCA";


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
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, unique=true)
     */
    private $codigo;


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
     * @return TipoDeEntrega
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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return TipoDeEntrega
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    
    public function __toString() {
        return $this->getNombre();
    }
}
