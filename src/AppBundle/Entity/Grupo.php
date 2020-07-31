<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Estudiante;
use Symfony\Component\Validator\Constraints as assert;
/**
 * Grupo
 *
 * @ORM\Table(name="grupo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GrupoRepository")
 */
class Grupo
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
     * @ORM\Column(name="semestre", type="string", length=100)
     * @assert\NotBlank
     * @assert\Regex(
     *      pattern="/[a-zA-Z ]+/",
     *      message="El semestre contiene un numero"
     * )
     * @assert\Length(
     *      min = 3,
     *      max = 20,
     *      minMessage = "El campo semestre debería contener {{ limit }} caracteres mínimo",
     *      maxMessage = "El campo semestre debería contener {{ limit }} caracteres máximo"
     * )
     */
    private $semestre;

    /**
     * @var string
     *
     * @ORM\Column(name="grupo", type="string", length=20)
     * @assert\NotBlank
     * @assert\Regex(
     *      pattern="/[a-zA-Z ]+/",
     *      message="El grupo contiene un numero"
     * )
     * @assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "El campo grupo debería contener {{ limit }} caracteres mínimo",
     *      maxMessage = "El campo grupo debería contener {{ limit }} caracteres máximo"
     * )
     */
    private $grupo;

    /**
     * @var string
     *
     * @ORM\Column(name="turno", type="string", length=20)
     */
    private $turno;

    /**
     * @var Estudiante
     * 
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Estudiante", mappedBy="grupo")
     */
    private $estudiante;
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
     * Set semestre
     *
     * @param string $semestre
     *
     * @return Grupo
     */
    public function setSemestre($semestre)
    {
        $this->semestre = $semestre;

        return $this;
    }

    /**
     * Get semestre
     *
     * @return string
     */
    public function getSemestre()
    {
        return $this->semestre;
    }

    /**
     * Set grupo
     *
     * @param string $grupo
     *
     * @return Grupo
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return string
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set turno
     *
     * @param string $turno
     *
     * @return Grupo
     */
    public function setTurno($turno)
    {
        $this->turno = $turno;

        return $this;
    }

    /**
     * Get turno
     *
     * @return string
     */
    public function getTurno()
    {
        return $this->turno;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->estudiante = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add estudiante
     *
     * @param \AppBundle\Entity\Estudiante $estudiante
     *
     * @return Grupo
     */
    public function addEstudiante(\AppBundle\Entity\Estudiante $estudiante)
    {
        $this->estudiante[] = $estudiante;

        return $this;
    }

    /**
     * Remove estudiante
     *
     * @param \AppBundle\Entity\Estudiante $estudiante
     */
    public function removeEstudiante(\AppBundle\Entity\Estudiante $estudiante)
    {
        $this->estudiante->removeEstudiante($estudiante);
    }

    /**
     * Get estudiante
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEstudiante()
    {
        return $this->estudiante;
    }
}
