<?php

namespace BSUIR\IndividualPlanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * OtherWork
 */
class OtherWork
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
     * @var OtherItems
     */
    private $otherItems;

    public function __construct()
    {
        $this->otherItems = new ArrayCollection();
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
     * @return OtherWork
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
     * @return OtherWork
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
     * @return OtherItems
     */
    public function getOtherItems()
    {
        return $this->otherItems;
    }

    /**
     * @param OtherItems $otherItems
     */
    public function setOtherItems($otherItems)
    {
        $this->otherItems = $otherItems;
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
