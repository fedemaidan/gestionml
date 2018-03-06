<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicacionML
 *
 * @ORM\Table(name="publicacion_ml")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicacionMLRepository")
 */
class PublicacionML
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
     * @ORM\Column(name="id_ml", type="string", length=255, unique=true)
     */
    private $idMl;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_compra", type="decimal", precision=10, scale=2)
     */
    private $precioCompra;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true, unique=true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="vendedor", type="string", length=255)
     */
    private $vendedor;

    /**
     * @var string
     *
     * @ORM\Column(name="imagenes", type="string", length=2500, nullable=true)
     */
    private $imagenes;

    /**
     * @var int
     *
     * @ORM\Column(name="cantidadVendidos", type="integer", nullable=true)
     */
    private $cantidadVendidos;

    /**
     * @var string
     *
     * @ORM\Column(name="categoria_ml", type="string", length=255)
     */
    private $categoriaML;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255, nullable=true)
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255, nullable=true)
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="mpn", type="string", length=255, nullable=true)
     */
    private $mpn;

    /**
     * @var string
     *
     * @ORM\Column(name="upc", type="bigint", nullable=true)
     */
    private $upc;

    /**
     * @var string
     *
     * @ORM\Column(name="ean", type="bigint", nullable=true)
     */
    private $ean;
    
    /**
     * @var Producto
     * @ORM\ManyToOne(targetEntity="Producto")
     * @ORM\JoinColumn(nullable=true)
     */
    private $producto;

    /**
     * @ORM\ManyToMany(targetEntity="AtributoML", inversedBy="publicacionML")
     * @ORM\JoinTable(name="publicaciones_atributos_ml")
     */
    private $atributos;

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
     * Set idMl
     *
     * @param string $idMl
     *
     * @return PublicacionML
     */
    public function setIdMl($idMl)
    {
        $this->idMl = $idMl;

        return $this;
    }

    /**
     * Get idMl
     *
     * @return string
     */
    public function getIdMl()
    {
        return $this->idMl;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return PublicacionML
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
     * Set precioCompra
     *
     * @param string $precioCompra
     *
     * @return PublicacionML
     */
    public function setPrecioCompra($precioCompra)
    {
        $this->precioCompra = $precioCompra;

        return $this;
    }

    /**
     * Get precioCompra
     *
     * @return string
     */
    public function getPrecioCompra()
    {
        return $this->precioCompra;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return PublicacionML
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set vendedor
     *
     * @param string $vendedor
     *
     * @return PublicacionML
     */
    public function setVendedor($vendedor)
    {
        $this->vendedor = $vendedor;

        return $this;
    }

    /**
     * Get vendedor
     *
     * @return string
     */
    public function getVendedor()
    {
        return $this->vendedor;
    }


    /**
     * Set categoriaMl
     *
     * @param string $categoriaMl
     *
     * @return PublicacionML
     */
    public function setCategoriaML($categoriaMl)
    {
        $this->categoriaML = $categoriaMl;

        return $this;
    }

    /**
     * Get vendedor
     *
     * @return string
     */
    public function getCategoriaML()
    {
        return $this->categoriaML;
    }


    /**
     * Set imagenes
     *
     * @param string $imagenes
     *
     * @return PublicacionML
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
     * Set cantidadVendidos
     *
     * @param integer $cantidadVendidos
     *
     * @return PublicacionML
     */
    public function setCantidadVendidos($cantidadVendidos)
    {
        $this->cantidadVendidos = $cantidadVendidos;

        return $this;
    }

    /**
     * Get cantidadVendidos
     *
     * @return int
     */
    public function getCantidadVendidos()
    {
        return $this->cantidadVendidos;
    }

    public function getAtributos() {
        return $this->atributos;
    }

    public function setAtributos($atributos) {
        return $this->atributos = $atributos;
    }

    public function addAtributo($attr) {
        $this->atributos[] = $attr;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->atributos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return PublicacionML
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set model
     *
     * @param string $model
     *
     * @return PublicacionML
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set mpn
     *
     * @param string $mpn
     *
     * @return PublicacionML
     */
    public function setMpn($mpn)
    {
        $this->mpn = $mpn;

        return $this;
    }

    /**
     * Get mpn
     *
     * @return string
     */
    public function getMpn()
    {
        return $this->mpn;
    }

    /**
     * Set upc
     *
     * @param string $upc
     *
     * @return PublicacionML
     */
    public function setUpc($upc)
    {
        $this->upc = $upc;

        return $this;
    }

    /**
     * Get upc
     *
     * @return string
     */
    public function getUpc()
    {
        return $this->upc;
    }

    /**
     * Remove atributo
     *
     * @param \AppBundle\Entity\AtributoML $atributo
     */
    public function removeAtributo(\AppBundle\Entity\AtributoML $atributo)
    {
        $this->atributos->removeElement($atributo);
    }

//trait
    public function getImagenesFoto() {
        $ima = explode(',', $this->getImagenes());
        $retornar = "";
        foreach ($ima as $key => $value) {
            $retornar .= "<img src='".$value."'></img>";
        }
        return $retornar;
    }

public function getImagenUrlByIndex($i) {
        $ima = explode(',', $this->getImagenes());
        if (count($ima) > $i)
            return $ima[$i];
        return "";
    }

public function getImagenPrincipal() {
        return "<img src='".$this->getImagenUrlByIndex(0)."'></img>";
    }


    /**
     * Set ean
     *
     * @param integer $ean
     *
     * @return PublicacionML
     */
    public function setEan($ean)
    {
        $this->ean = $ean;

        return $this;
    }

    /**
     * Get ean
     *
     * @return integer
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * Set producto
     *
     * @param \AppBundle\Entity\Producto $producto
     *
     * @return PublicacionML
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
     * Set url
     *
     * @param string $url
     *
     * @return PublicacionML
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
