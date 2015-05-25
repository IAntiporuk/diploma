<?php

namespace BSUIR\IndividualPlanBundle\Controller;

use BSUIR\IndividualPlanBundle\Entity\EducationWorkPlan;
use BSUIR\IndividualPlanBundle\Form\Type\EducationWorkPlanType;
use Symfony\Component\HttpFoundation\Request;

class EducationWorkPlanController extends BaseController
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

        $educationWorkPlan = new EducationWorkPlan();
        $form = $this->createForm(new EducationWorkPlanType(), $educationWorkPlan);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getManager();
            try{
                $educationWorkPlan->setIndividualPlan($individualPlan);
                $em->persist($educationWorkPlan);
                $em->persist($individualPlan);
                $em->flush();
            } catch (\Exception $e) {
                die($e->getMessage());
            }

            return $this->redirect($this->generateUrl('education_work_plan_update', array(
                'ewp_id' => $educationWorkPlan->getId(),
            )));
        }

        return $this->render('BSUIRIndividualPlanBundle:EducationWorkPlan:create.html.twig', array(
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
        $ewpId = (int) $request->get('ewp_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\EducationWorkPlan $ewpRep */
        $ewpRep = $this->getRepository('BSUIRIndividualPlanBundle:EducationWorkPlan');
        /** @var EducationWorkPlan $ewp */
        $ewp = $ewpRep->findOneByIdAndProfessor($ewpId, $professor);

        if (null === $ewp) {
            //TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $form = $this->createForm(new EducationWorkPlanType(), $ewp);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getManager();
            try{
                $em->persist($ewp);
                $em->flush();
            } catch (\Exception $e) {
                die($e->getMessage());
            }
        }

        return $this->render('BSUIRIndividualPlanBundle:EducationWorkPlan:update.html.twig', array(
            'ewp' => $ewp,
            'form' => $form->createView(),
            'ewpi' => '',
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction(Request $request)
    {
        $professor = $this->getUser();
        $ewpId = (int) $request->get('ewp_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\EducationWorkPlan $ewpRep */
        $ewpRep = $this->getRepository('BSUIRIndividualPlanBundle:EducationWorkPlan');
        /** @var EducationWorkPlan $ewp */
        $ewp = $ewpRep->findOneByIdAndProfessor($ewpId, $professor);

        if (null === $ewp) {
            //TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $individualPlanId = $ewp->getIndividualPlan()->getId();
        $em = $this->getManager();
        try{
            $em->remove($ewp);
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
        $ewpId = (int) $request->get('ewp_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\EducationWorkPlan $ewpRep */
        $ewpRep = $this->getRepository('BSUIRIndividualPlanBundle:EducationWorkPlan');
        /** @var EducationWorkPlan $ewp */
        $ewp = $ewpRep->findOneByIdAndProfessor($ewpId, $professor);

        if (null === $ewp) {
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