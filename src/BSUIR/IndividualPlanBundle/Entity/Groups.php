<?php

namespace BSUIR\IndividualPlanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Groups
 */
class Groups
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
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var Specialty
     */
    private $specialty;

    /**
     * @var EducationWorkPlanItems
     */
    private $educationWorkPlanItems;

    public function __construct()
    {
        $this->educationWorkPlanItems = new ArrayCollection();
    }

    /**
     * @return EducationWorkPlanItems
     */
    public function getEducationWorkPlanItems()
    {
        return $this->educationWorkPlanItems;
    }

    /**
     * @param EducationWorkPlanItems $educationWorkPlanItems
     */
    public function setEducationWorkPlanItems($educationWorkPlanItems)
    {
        $this->educationWorkPlanItems = $educationWorkPlanItems;
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
     * @return Groups
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Groups
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
