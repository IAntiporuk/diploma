<?php

namespace BSUIR\IndividualPlanBundle\Controller;

use BSUIR\IndividualPlanBundle\Entity\IndividualPlans;
use BSUIR\IndividualPlanBundle\Form\Type\IndividualPlansType;
use Symfony\Component\HttpFoundation\Request;

class IndividualPlansController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $professor = $this->getUser();
        $plans = $this->getRepository('BSUIRIndividualPlanBundle:IndividualPlans')->findByProfessor($professor);

        return $this->render('BSUIRIndividualPlanBundle:IndividualPlans:index.html.twig', array(
            'plans' => $plans,
        ));
    }

    /**
     * create individual plan
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $individualPlan = new IndividualPlans();
        $form = $this->createForm(new IndividualPlansType(), $individualPlan);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getManager();
            $individualPlan->setProfessor($this->getUser());
            try{
                $em->persist($individualPlan);
                $em->flush();
            } catch( \Exception $e) {
                die($e->getMessage());
            }

            return $this->redirect($this->generateUrl('individual_plan_update', array(
                'ip_id' => $individualPlan->getId(),
            )));
        }

        return $this->render('BSUIRIndividualPlanBundle:IndividualPlans:create.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * create individual plan
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request)
    {
        $individualPlanId = $request->get('ip_id');
        $professor = $this->getUser();

        $individualPlan = $this->getRepository('BSUIRIndividualPlanBundle:IndividualPlans')->findOneBy(array(
                'id' => $individualPlanId,
                'professor' => $professor,
            ));

        if (null === $individualPlan) {
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $form = $this->createForm(new IndividualPlansType(), $individualPlan);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getManager();
            $individualPlan->setProfessor($this->getUser());
            try{
                $em->persist($individualPlan);
                $em->flush();
            } catch( \Exception $e) {
                // TODO: create notice
                die($e->getMessage());
            }
        }

        return $this->render('BSUIRIndividualPlanBundle:IndividualPlans:update.html.twig', array(
            'form' => $form->createView(),
            'plan' => $individualPlan,
        ));
    }

    /**
     * remove individual plan by id
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction(Request $request) {
        $individualPlanId = $request->get('ip_id');
        $professor = $this->getUser();
        $individualPlan = $this->getRepository('BSUIRIndividualPlanBundle:IndividualPlans')->findOneBy(array(
            'id' => $individualPlanId,
            'professor' => $professor,
        ));

        if (null === $individualPlan) {
            // TODO: create notice
            die('There is no Individual Plan with id ' . $individualPlanId);
        }

        $em = $this->getManager();
        try{
            $em->remove($individualPlan);
            $em->flush();
        } catch (\Exception $e) {
            // TODO: create notice
            die($e->getMessage());
        }

        return $this->redirect($this->generateUrl('individual_plan_index'));
    }
}
