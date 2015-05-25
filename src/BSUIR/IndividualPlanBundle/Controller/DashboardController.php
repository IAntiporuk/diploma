<?php

namespace BSUIR\IndividualPlanBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends BaseController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $professor = $this->getUser();
        $plans = $this->getRepository('BSUIRIndividualPlanBundle:IndividualPlans')->findByProfessor($professor);

        return $this->render('BSUIRIndividualPlanBundle:Dashboard:index.html.twig', array(
            'plans' => $plans,
        ));
    }
}