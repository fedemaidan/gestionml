<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicacionML
 *
 * @ORM\Table(name="publicacion_propia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicacionPropiaRepository")
 */
class PublicacionPropia extends PublicacionML
{
	/**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

	/**
     * @var cuenta
     * @ORM\ManyToOne(targetEntity="Cuenta")
     * @ORM\JoinColumn(nullable=true)
     */
    private $cuenta;	    
}
