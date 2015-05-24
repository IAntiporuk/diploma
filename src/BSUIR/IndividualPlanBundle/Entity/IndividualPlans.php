<?php

namespace BSUIR\IndividualPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndividualPlan
 */
class IndividualPlans
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $session;

    /**
     * @var Professors
     */
    private $professor;

    /**
     * @var EducationalMethodicalWork
     */
    private $educationalMethodicalWork;

    /**
     * @var ScientificWork
     */
    private $scientificWork;

    /**
     * @var OtherWork
     */
    private $otherWork;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return IndividualPlan
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
     * Set session
     *
     * @param integer $session
     * @return IndividualPlan
     */
    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return integer 
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @return Professors
     */
    public function getProfessor()
    {
        return $this->professor;
    }

    /**
     * @param Professors $professor
     */
    public function setProfessor($professor)
    {
        $this->professor = $professor;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return EducationalMethodicalWork
     */
    public function getEducationalMethodicalWork()
    {
        return $this->educationalMethodicalWork;
    }

    /**
     * @param EducationalMethodicalWork $educationalMethodicalWork
     */
    public function setEducationalMethodicalWork($educationalMethodicalWork)
    {
        $this->educationalMethodicalWork = $educationalMethodicalWork;
    }

    /**
     * @return ScientificWork
     */
    public function getScientificWork()
    {
        return $this->scientificWork;
    }

    /**
     * @param ScientificWork $scientificWork
     */
    public function setScientificWork($scientificWork)
    {
        $this->scientificWork = $scientificWork;
    }

    /**
     * @return OtherWork
     */
    public function getOtherWork()
    {
        return $this->otherWork;
    }

    /**
     * @param OtherWork $otherWork
     */
    public function setOtherWork($otherWork)
    {
        $this->otherWork = $otherWork;
    }

    /**
     * LifecycleCallbacks
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * LifecycleCallbacks
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
}
