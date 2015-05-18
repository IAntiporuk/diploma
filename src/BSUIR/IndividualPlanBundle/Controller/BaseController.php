<?php

namespace BSUIR\IndividualPlanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    public function getRepository($repository) {
        return $this->getDoctrine()->getRepository($repository);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getManager() {
        return $this->getDoctrine()->getManager();
    }
}
