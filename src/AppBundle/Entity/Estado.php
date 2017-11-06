<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estado
 *
 * @ORM\Table(name="estado")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EstadoRepository")
 */
class Estado
{
          
    const ORM_ENTITY = "AppBundle:Estado";
    const DEVUELTO_GARANTIA = "DEVUELTO_GARANTIA";
    const CANCELADO_INNOVA = "CANCELADO_INNOVA";
    const ENTREGADO = "ENTREGADO";
    const DEPOSITO_INNOVA = "DEPOSITO_INNOVA";
    const CANCELADO_CLIENTE = "CANCELADO_CLIENTE";
    const DEPOSITO_ARG = "DEPOSITO_ARG";
    const IMPORTANDO = "IMPORTANDO";
    const DEPOSITO_EEUU = "DEPOSITO_EEUU";
    const COMPRADO = "COMPRADO";
    const PROCESO_DE_COMPRA = "PROCESO_DE_COMPRA";
    const RESERVADO = "RESERVADO";

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
     * @ORM\Column(name="descripcion", type="string", length=255, unique=true)
     */
    private $descripcion;


    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, unique=true)
     */
    private $codigo;
    
    /**
     * @var int
     *
     * @ORM\Column(name="tiempo_minimo_estimado", type="integer", nullable=true)
     */
    private $tiempoMinimoEstimado;

    /**
     * @var int
     *
     * @ORM\Column(name="tiempo_maximo_estimado", type="integer", nullable=true)
     */
    private $tiempoMaximoEstimado;


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
     * @return Estado
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
     * Set tiempoMinimoEstimado
     *
     * @param integer $tiempoMinimoEstimado
     *
     * @return Estado
     */
    public function setTiempoMinimoEstimado($tiempoMinimoEstimado)
    {
        $this->tiempoMinimoEstimado = $tiempoMinimoEstimado;

        return $this;
    }

    /**
     * Get tiempoMinimoEstimado
     *
     * @return int
     */
    public function getTiempoMinimoEstimado()
    {
        return $this->tiempoMinimoEstimado;
    }

    /**
     * Set tiempoMaximoEstimado
     *
     * @param integer $tiempoMaximoEstimado
     *
     * @return Estado
     */
    public function setTiempoMaximoEstimado($tiempoMaximoEstimado)
    {
        $this->tiempoMaximoEstimado = $tiempoMaximoEstimado;

        return $this;
    }

    /**
     * Get tiempoMaximoEstimado
     *
     * @return int
     */
    public function getTiempoMaximoEstimado()
    {
        return $this->tiempoMaximoEstimado;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Estado
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Estado
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
        return $this->getCodigo();
    }
}
