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
     * @var integer
     */
    private $session;

    /**
     * @var Professors
     */
    private $professor;


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


}
