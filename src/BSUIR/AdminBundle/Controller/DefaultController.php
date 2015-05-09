<?php

namespace BSUIR\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BSUIRAdminBundle:Default:index.html.twig', array('name' => $name));
    }
}
