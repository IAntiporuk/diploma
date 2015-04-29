<?php

namespace BSUIR\IndividualPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Specialty
 */
class Specialty
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
     * @var integer
     */
    private $faculty;


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
     * @return Specialty
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
     * Set faculty
     *
     * @param integer $faculty
     * @return Specialty
     */
    public function setFacultyId($faculty)
    {
        $this->faculty = $faculty;

        return $this;
    }

    /**
     * Get faculty
     *
     * @return integer 
     */
    public function getFaculty()
    {
        return $this->faculty;
    }
}
