<?php

namespace BSUIR\IndividualPlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Professors
 */
class Professors implements UserInterface, \Serializable
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $secondName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     */
    private $academicTitle;

    /**
     * @var string
     */
    private $scholasticDegree;

    /**
     * @var \DateTime
     */
    private $competitionSelected;

    /**
     * @var Departments
     */
    private $department;

    /**
     * @var boolean
     */
    private $isHead;

    /**
     * @var IndividualPlan
     */
    private $individualPlans;

    public function __construct()
    {
        $this->salt = md5(uniqid(null, true));
    }

    /**
     * @return Departments
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param Departments $department
     */
    public function setDepartment($department)
    {
        $this->department = $department;
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
     * Set firstName
     *
     * @param string $firstName
     * @return Professors
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set secondName
     *
     * @param string $secondName
     * @return Professors
     */
    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;

        return $this;
    }

    /**
     * Get secondName
     *
     * @return string 
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Professors
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Professors
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Professors
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Professors
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set academicTitle
     *
     * @param string $academicTitle
     * @return Professors
     */
    public function setAcademicTitle($academicTitle)
    {
        $this->academicTitle = $academicTitle;

        return $this;
    }

    /**
     * Get academicTitle
     *
     * @return string 
     */
    public function getAcademicTitle()
    {
        return $this->academicTitle;
    }

    /**
     * Set scholasticDegree
     *
     * @param string $scholasticDegree
     * @return Professors
     */
    public function setScholasticDegree($scholasticDegree)
    {
        $this->scholasticDegree = $scholasticDegree;

        return $this;
    }

    /**
     * Get scholasticDegree
     *
     * @return string 
     */
    public function getScholasticDegree()
    {
        return $this->scholasticDegree;
    }

    /**
     * Set competitionSelected
     *
     * @param \DateTime $competitionSelected
     * @return Professors
     */
    public function setCompetitionSelected($competitionSelected)
    {
        $this->competitionSelected = $competitionSelected;

        return $this;
    }

    /**
     * Get competitionSelected
     *
     * @return \DateTime 
     */
    public function getCompetitionSelected()
    {
        return $this->competitionSelected;
    }

    /**
     * @return boolean
     */
    public function isIsHead()
    {
        return $this->isHead;
    }

    /**
     * @param boolean $isHead
     */
    public function setIsHead($isHead)
    {
        $this->isHead = $isHead;
    }

    /**
     * @return IndividualPlan
     */
    public function getIndividualPlans()
    {
        return $this->individualPlans;
    }

    /**
     * @param IndividualPlan $individualPlans
     */
    public function setIndividualPlans($individualPlans)
    {
        $this->individualPlans = $individualPlans;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
             $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
             $this->salt
            ) = unserialize($serialized);
    }
}
