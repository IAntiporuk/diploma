<?php

namespace BSUIR\IndividualPlanBundle\Controller;

use BSUIR\IndividualPlanBundle\Entity\EducationWorkExecution;
use BSUIR\IndividualPlanBundle\Form\Type\EducationWorkExecutionType;
use Symfony\Component\HttpFoundation\Request;

class EducationWorkExecutionController extends BaseController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $individualPlanId = (int) $request->get('ip_id');
        $professor = $this->getUser();
        /** @var \BSUIR\IndividualPlanBundle\Entity\IndividualPlans $individualPlan */
        $individualPlan = $this
            ->getRepository('BSUIRIndividualPlanBundle:IndividualPlans')
            ->findOneBy(array(
                'id' => $individualPlanId,
                'professor' => $professor,
            ));

        if (null === $individualPlan) {
            //TODO: set message error
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $educationWorkExecution = new EducationWorkExecution();
        $form = $this->createForm(new EducationWorkExecutionType(), $educationWorkExecution);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getManager();
            try{
                $educationWorkExecution->setIndividualPlan($individualPlan);
                $em->persist($educationWorkExecution);
                $em->persist($individualPlan);
                $em->flush();
            } catch (\Exception $e) {
                die($e->getMessage());
            }

            return $this->redirect($this->generateUrl('education_work_execution_update', array(
                'ewe_id' => $educationWorkExecution->getId(),
            )));
        }

        return $this->render('BSUIRIndividualPlanBundle:EducationWorkExecution:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request)
    {
        $professor = $this->getUser();
        $eweId = (int) $request->get('ewe_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\EducationWorkExecution $eweRep */
        $eweRep = $this->getRepository('BSUIRIndividualPlanBundle:EducationWorkExecution');
        /** @var EducationWorkExecution $ewe */
        $ewe = $eweRep->findOneByIdAndProfessor($eweId, $professor);

        if (null === $ewe) {
            //TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $form = $this->createForm(new EducationWorkExecutionType(), $ewe);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getManager();
            try{
                $em->persist($ewe);
                $em->flush();
            } catch (\Exception $e) {
                die($e->getMessage());
            }
        }

        return $this->render('BSUIRIndividualPlanBundle:EducationWorkExecution:update.html.twig', array(
            'ewe' => $ewe,
            'form' => $form->createView(),
            'ewei' => '',
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction(Request $request)
    {
        $professor = $this->getUser();
        $eweId = (int) $request->get('ewe_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\EducationWorkExecution $eweRep */
        $eweRep = $this->getRepository('BSUIRIndividualPlanBundle:EducationWorkExecution');
        /** @var EducationWorkExecution $ewe */
        $ewe = $eweRep->findOneByIdAndProfessor($eweId, $professor);

        if (null === $ewe) {
            //TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $individualPlanId = $ewe->getIndividualPlan()->getId();
        $em = $this->getManager();
        try{
            $em->remove($ewe);
            $em->flush();
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $this->redirect($this->generateUrl('individual_plan_update', array(
            'ip_id' => $individualPlanId,
        )));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function printAction(Request $request)
    {
        $professor = $this->getUser();
        $eweId = (int) $request->get('ewe_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\EducationWorkExecution $eweRep */
        $eweRep = $this->getRepository('BSUIRIndividualPlanBundle:EducationWorkExecution');
        /** @var EducationWorkExecution $ewe */
        $ewe = $eweRep->findOneByIdAndProfessor($eweId, $professor);

        if (null === $ewe) {
            //TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $otherItems = $this
            ->getRepository('BSUIRIndividualPlanBundle:OtherItems')
            ->findBy(array(
                'otherWork' => $otherWork->getId(),
            ));

        return $this->render('BSUIRIndividualPlanBundle:OtherWork:print.html.twig', array(
            'otherItems' => $otherItems,
        ));
    }
}