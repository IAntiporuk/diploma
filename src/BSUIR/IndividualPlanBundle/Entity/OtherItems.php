<?php

namespace BSUIR\IndividualPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OtherWork
 */
class OtherItems
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $work;

    /**
     * @var string
     */
    private $mark;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

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
     * Set work
     *
     * @param string $work
     * @return OtherItems
     */
    public function setWork($work)
    {
        $this->work = $work;

        return $this;
    }

    /**
     * Get work
     *
     * @return string 
     */
    public function getWork()
    {
        return $this->work;
    }

    /**
     * Set mark
     *
     * @param string $mark
     * @return OtherItems
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return string 
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OtherItems
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
     * @return OtherItems
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
