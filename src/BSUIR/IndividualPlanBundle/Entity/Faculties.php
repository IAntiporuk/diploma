<?php

namespace BSUIR\IndividualPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection as ArrayCollection;

/**
 * Faculties
 */
class Faculties
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
     * @var Specialty
     */
    private $specialty;

    /**
     * @var Departments
     */
    private $departments;

    public function __construct()
    {
        $this->specialty = new ArrayCollection();
        $this->departments = new ArrayCollection();
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
     * @return Faculties
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
     * @return Departments
     */
    public function getDepartments()
    {
        return $this->departments;
    }

    /**
     * @param Departments $departments
     */
    public function setDepartments($departments)
    {
        $this->departments = $departments;
    }

    /**
     * @return Specialty
     */
    public function getSpecialty()
    {
        return $this->specialty;
    }

    /**
     * @param Specialty $specialty
     */
    public function setSpecialty($specialty)
    {
        $this->specialty = $specialty;
    }

}
