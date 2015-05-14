<?php

namespace BSUIR\IndividualPlanBundle\Form\Model;

use BSUIR\IndividualPlanBundle\Entity\Professors;
use Symfony\Component\Validator\Constraints as Assert;


class Registration
{
    /**
     * @Assert\Type(type="BSUIR\IndividualPlanBundle\Entity\Professors")
     * @Assert\Valid()
     */
    protected $professors;

    protected $password;

    public function setProfessors(Professors $professors)
    {
        $this->professors = $professors;
    }

    public function getProfessors()
    {
        return $this->professors;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


}