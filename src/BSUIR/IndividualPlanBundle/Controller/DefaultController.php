<?php

namespace BSUIR\IndividualPlanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BSUIRIndividualPlanBundle:Default:index.html.twig', array('name' => $name));
    }
}
