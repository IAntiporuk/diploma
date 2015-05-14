<?php

namespace BSUIR\IndividualPlanBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request) {

        return $this->render(
            'BSUIRIndividualPlanBundle:Dashboard:index.html.twig',
            array('test' => 'Olololo')
        );
    }
}