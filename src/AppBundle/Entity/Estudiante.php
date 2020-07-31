<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Grupo;
use Symfony\Component\Validator\Constraints as assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Estudiante
 *
 * @ORM\Table(name="estudiante")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EstudianteRepository")
 * @UniqueEntity("email", message="Este email ya está en uso")
 */
class Estudiante
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
     * @ORM\Column(name="nombre", type="string", length=50)
     * @assert\NotBlank
     * @assert\Regex(
     *      pattern="/[a-zA-Z ]+/",
     *      message="Tu apellido contiene un numero"
     * )
     * @assert\Length(
     *      min = 3,
     *      max = 20,
     *      minMessage = "El campo nombre debería contener {{ limit }} caracteres mínimo",
     *      maxMessage = "El campo nombre debería contener {{ limit }} caracteres máximo"
     * )
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=50)
     * @assert\NotBlank
     * @assert\Regex(
     *      pattern="/[a-zA-Z ]+/",
     *      message="Tu apellido contiene un numero"
     * )
     * @assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "El campo apellido debería contener {{ limit }} caracteres mínimo",
     *      maxMessage = "El campo apellido debería contener {{ limit }} caracteres máximo"
     * )
     */
    private $apellidos;

    /**
     * @var int
     *
     * @ORM\Column(name="edad", type="integer", nullable=true)
     * @assert\NotBlank
     * @assert\Range(
     *      min = 1,
     *      max = 99,
     *      minMessage = "Tu edad debe ser mayor a 0",
     *      maxMessage = "Tu edad debe ser menor o igual a 99"
     * )
     */
    private $edad;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @assert\NotBlank
     * @assert\Email(
     *     message = "El email '{{ value }}' no es un email válido",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=20, nullable=true)
     * @assert\NotBlank
     * @assert\Regex(
     *      pattern="/[0-9]+/",
     *      message="El campo teléfono solo debe contener números"
     * )
     * @assert\Length(
     *      min = 10,
     *      max = 10,
     * )
     */
    private $telefono;

    /**
     * @var Grupo
     * 
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Grupo", inversedBy="estudiante")
     */
    private $grupo;

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
     * @return Estudiante
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
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Estudiante
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set edad
     *
     * @param integer $edad
     *
     * @return Estudiante
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad
     *
     * @return int
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Estudiante
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Estudiante
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
     * Set grupo
     *
     * @param \AppBundle\Entity\Grupo $grupo
     *
     * @return Estudiante
     */
    public function setGrupo(\AppBundle\Entity\Grupo $grupo = null)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return \AppBundle\Entity\Grupo
     */
    public function getGrupo()
    {
        return $this->grupo;
    }
}
