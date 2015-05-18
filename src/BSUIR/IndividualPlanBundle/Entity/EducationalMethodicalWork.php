<?php

namespace BSUIR\IndividualPlanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * EducationalMethodicalWork
 */
class EducationalMethodicalWork
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
     * @var IndividualPlans
     */
    private $individualPlan;

    /**
     * @var ArrayCollection
     */
    private $educationalMethodicalItems;

    public function __construct()
    {
        $this->educationalMethodicalItems = new ArrayCollection();
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return EducationalMethodicalWork
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
     * @return EducationalMethodicalWork
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

    /**
     * @return ArrayCollection
     */
    public function getEducationalMethodicalItems()
    {
        return $this->educationalMethodicalItems;
    }

    /**
     * @param ArrayCollection $educationalMethodicalItems
     */
    public function setEducationalMethodicalItems($educationalMethodicalItems)
    {
        $this->educationalMethodicalItems = $educationalMethodicalItems;
    }
}
