<?php

namespace BSUIR\IndividualPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EducationWorkExecution
 */
class EducationWorkExecution
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
     * @return array
     */
    public static function getSemesters()
    {
        return array(
            1 => 'Осенний',
            2 => 'Весенний',
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
     * @return EducationWorkExecution
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
     * @return EducationWorkExecution
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
     * @return EducationWorkExecution
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
