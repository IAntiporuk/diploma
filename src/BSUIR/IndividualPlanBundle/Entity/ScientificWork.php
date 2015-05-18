<?php

namespace BSUIR\IndividualPlanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ScientificWork
 */
class ScientificWork
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $topicName;

    /**
     * @var string
     */
    private $partName;

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
    private $scientificItems;

    public function __construct()
    {
        $this->scientificItems = new ArrayCollection();
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
     * Set topicName
     *
     * @param string $topicName
     * @return ScientificWork
     */
    public function setTopicName($topicName)
    {
        $this->topicName = $topicName;

        return $this;
    }

    /**
     * Get topicName
     *
     * @return string 
     */
    public function getTopicName()
    {
        return $this->topicName;
    }

    /**
     * Set partName
     *
     * @param string $partName
     * @return ScientificWork
     */
    public function setPartName($partName)
    {
        $this->partName = $partName;

        return $this;
    }

    /**
     * Get partName
     *
     * @return string 
     */
    public function getPartName()
    {
        return $this->partName;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ScientificWork
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
     * @return ScientificWork
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
    public function getScientificItems()
    {
        return $this->scientificItems;
    }

    /**
     * @param ArrayCollection $scientificItems
     */
    public function setScientificItems($scientificItems)
    {
        $this->scientificItems = $scientificItems;
    }
}
