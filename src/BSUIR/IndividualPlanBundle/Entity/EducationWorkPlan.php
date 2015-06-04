<?php

namespace BSUIR\IndividualPlanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * EducationWorkPlan
 */
class EducationWorkPlan
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $semester;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var IndividualPlans
     */
    private $individualPlan;

    /**
     * @var EducationWorkPlanItems
     */
    private $educationWorkPlanItems;

    const AUTUMN_SEMESTER = 1;

    const SPRING_SEMESTER = 2;

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
     * @return array
     */
    public static function getSemesters()
    {
        return array(
            self::AUTUMN_SEMESTER => 'Осенний',
            self::SPRING_SEMESTER => 'Весенний',
        );
    }

    /**
     * @return mixed
     */
    public function getStringSemester() {
        return self::getSemesters()[$this->getSemester()];
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
     * Set semester
     *
     * @param integer $semester
     * @return EducationWorkPlan
     */
    public function setSemester($semester)
    {
        $this->semester = $semester;

        return $this;
    }

    /**
     * Get semester
     *
     * @return integer 
     */
    public function getSemester()
    {
        return $this->semester;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return EducationWorkPlan
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return EducationWorkPlan
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return IndividualPlans
     */
    public function getIndividualPlan()
    {
        return $this->individualPlan;
    }

    /**
     * @param IndividualPlans $individualPlan
     */
    public function setIndividualPlan($individualPlan)
    {
        $this->individualPlan = $individualPlan;
    }

    /**
     * LifecycleCallbacks
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * lifecycleCallbacks
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
}
