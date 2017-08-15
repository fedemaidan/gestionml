<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 *
 * @ORM\Table(name="producto")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductoRepository")
 */
class Producto
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
     * @ORM\Column(name="id_ebay", type="string", length=255)
     */
    private $idEbay;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_compra", type="string", length=255)
     */
    private $precio_compra;

    /**
     * @var string
     *
     * @ORM\Column(name="link_publicacion", type="string", length=255, nullable=true)
     */
    private $linkPublicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="vendedor", type="string", length=255, nullable=true)
     */
    private $vendedor;

    /**
     * @var string
     *
     * @ORM\Column(name="imagenes", type="string", length=1500, nullable=true)
     */
    private $imagenes;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad_vendidos_ebay", type="string", length=255)
     */
    private $cantidadVendidosEbay;

    /**
     * @var string
     *
     * @ORM\Column(name="categoria", type="string", length=255)
     */
    private $categoria;


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
     * Set idEbay
     *
     * @param string $idEbay
     *
     * @return Producto
     */
    public function setIdEbay($idEbay)
    {
        $this->idEbay = $idEbay;

        return $this;
    }

    /**
     * Get idEbay
     *
     * @return string
     */
    public function getIdEbay()
    {
        return $this->idEbay;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Producto
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set precio_compra
     *
     * @param string $precio_compra
     *
     * @return Producto
     */
    public function setPrecioCompra($precio)
    {
        $this->precio_compra = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecioCompra()
    {
        return $this->precio_compra;
    }

    /**
     * Set linkPublicacion
     *
     * @param string $linkPublicacion
     *
     * @return Producto
     */
    public function setLinkPublicacion($linkPublicacion)
    {
        $this->linkPublicacion = $linkPublicacion;

        return $this;
    }

    /**
     * Get linkPublicacion
     *
     * @return string
     */
    public function getLinkPublicacion()
    {
        return $this->linkPublicacion;
    }

    /**
     * Set imagenes
     *
     * @param string $imagenes
     *
     * @return Producto
     */
    public function setImagenes($imagenes)
    {
        $this->imagenes = $imagenes;

        return $this;
    }

    /**
     * Get imagenes
     *
     * @return string
     */
    public function getImagenes()
    {
        return $this->imagenes;
    }

    /**
     * Set cantidadVendidosEbay
     *
     * @param string $cantidadVendidosEbay
     *
     * @return Producto
     */
    public function setCantidadVendidosEbay($cantidadVendidosEbay)
    {
        $this->cantidadVendidosEbay = $cantidadVendidosEbay;

        return $this;
    }

    /**
     * Get cantidadVendidosEbay
     *
     * @return string
     */
    public function getCantidadVendidosEbay()
    {
        return $this->cantidadVendidosEbay;
    }

    /**
     * Set categoria
     *
     * @param string $categoria
     *
     * @return Producto
     */
    public function setJson($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get json
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set vendedor
     *
     * @param string $vendedor
     *
     * @return Producto
     */
    public function setVendedor($vendedor)
    {
        $this->vendedor = $vendedor;

        return $this;
    }

    /**
     * Get json
     *
     * @return string
     */
    public function getVendedor()
    {
        return $this->vendedor;
    }

    public function getImagenesFoto() {
        $ima = explode(',', $this->getImagenes());
        $retornar = "";
        foreach ($ima as $key => $value) {
            $retornar .= "<img src='".$value."'></img>";
        }
        return $retornar;
    }

    public function getImagenPrincipal() {
        $ima = explode(',', $this->getImagenes());
        return "<img src='".$ima[0]."'></img>";
        
        
    }

}