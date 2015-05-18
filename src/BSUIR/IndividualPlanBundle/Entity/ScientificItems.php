<?php

namespace BSUIR\IndividualPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScientificItems
 */
class ScientificItems
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $workName;

    /**
     * @var \DateTime
     */
    private $startedAt;

    /**
     * @var \DateTime
     */
    private $finishedAt;

    /**
     * @var integer
     */
    private $markFirst;

    /**
     * @var integer
     */
    private $markSecond;

    /**
     * @var string
     */
    private $note;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var ScientificWork
     */
    private $scientificWork;

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
     * Set workName
     *
     * @param string $workName
     * @return ScientificItems
     */
    public function setWorkName($workName)
    {
        $this->workName = $workName;

        return $this;
    }

    /**
     * Get workName
     *
     * @return string 
     */
    public function getWorkName()
    {
        return $this->workName;
    }

    /**
     * Set startedAt
     *
     * @param \DateTime $startedAt
     * @return ScientificItems
     */
    public function setStartedAt($startedAt)
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * Get startedAt
     *
     * @return \DateTime 
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }

    /**
     * Set finishedAt
     *
     * @param \DateTime $finishedAt
     * @return ScientificItems
     */
    public function setFinishedAt($finishedAt)
    {
        $this->finishedAt = $finishedAt;

        return $this;
    }

    /**
     * Get finishedAt
     *
     * @return \DateTime 
     */
    public function getFinishedAt()
    {
        return $this->finishedAt;
    }

    /**
     * Set markFirst
     *
     * @param integer $markFirst
     * @return ScientificItems
     */
    public function setMarkFirst($markFirst)
    {
        $this->markFirst = $markFirst;

        return $this;
    }

    /**
     * Get markFirst
     *
     * @return integer 
     */
    public function getMarkFirst()
    {
        return $this->markFirst;
    }

    /**
     * Set markSecond
     *
     * @param integer $markSecond
     * @return ScientificItems
     */
    public function setMarkSecond($markSecond)
    {
        $this->markSecond = $markSecond;

        return $this;
    }

    /**
     * Get markSecond
     *
     * @return integer 
     */
    public function getMarkSecond()
    {
        return $this->markSecond;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return ScientificItems
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createdAt
     * @return ScientificItems
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
     * @return ScientificItems
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
