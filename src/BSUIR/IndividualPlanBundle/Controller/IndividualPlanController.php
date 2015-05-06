<?php

namespace BSUIR\IndividualPlanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndividualPlanController extends Controller
{
    public function indexAction()
    {
        return $this->render(
            'BSUIRIndividualPlanBundle:IndividualPlan:index.html.twig',
            array('test' => 'Create your plan')
        );
    }
}
