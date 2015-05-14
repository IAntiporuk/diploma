<?php

namespace BSUIR\IndividualPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection as ArrayCollection;

/**
 * Departments
 */
class Departments
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Professors
     */
    private $professors;

    /**
     * @var Faculties
     */
    private $faculty;

    /**
     * @var Disciplines
     */
    private $disciplines;

    public function __construct() {
        $this->professors = new ArrayCollection();
        $this->disciplines = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Departments
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Faculties
     */
    public function getFaculty()
    {
        return $this->faculty;
    }

    /**
     * @param Faculties $faculty
     */
    public function setFaculty($faculty)
    {
        $this->faculty = $faculty;
    }

    /**
     * @return Professors
     */
    public function getProfessors()
    {
        return $this->professors;
    }

    /**
     * @param Professors $professors
     */
    public function setProfessors($professors)
    {
        $this->professors = $professors;
    }

    /**
     * @return Disciplines
     */
    public function getDisciplines()
    {
        return $this->disciplines;
    }

    /**
     * @param Disciplines $disciplines
     */
    public function setDisciplines($disciplines)
    {
        $this->disciplines = $disciplines;
    }

}
