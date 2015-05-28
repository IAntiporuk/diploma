<?php

namespace BSUIR\IndividualPlanBundle\Controller;

use BSUIR\IndividualPlanBundle\Entity\EducationWorkPlanItems;
use BSUIR\IndividualPlanBundle\Form\Type\EducationalMethodicalItemsType;
use BSUIR\IndividualPlanBundle\Form\Type\EducationWorkPlanItemsType;
use BSUIR\IndividualPlanBundle\Form\Type\EducationWorkPlanType;
use Symfony\Component\HttpFoundation\Request;

class EducationWorkPlanItemsController extends BaseController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $professor = $this->getUser();
        $ewpId = $request->get('ewp_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\EducationWorkPlan $ewpRep */
        $ewpRep = $this->getRepository('BSUIRIndividualPlanBundle:EducationWorkPlan');
        $ewp = $ewpRep->findOneByIdAndProfessor($ewpId, $professor);

        if (null === $ewp) {
            // TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $ewpi = new EducationWorkPlanItems();
        $form = $this->createForm(new EducationWorkPlanItemsType(), $ewpi);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getManager();
            $ewpi->setEducationWorkPlan($ewp);
            try {
                $em->persist($ewpi);
                $em->flush();
            } catch(\Exception $e) {
                //TODO: set error message
                die($e->getMessage());
            }

            return $this->redirect($this->generateUrl('education_work_plan_update', array(
                'ewp_id' => $ewpId,
            )));
        }

        return $this->render('BSUIRIndividualPlanBundle:EducationWorkPlanItems:create.html.twig', array(
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
        $eduMethItemId = $request->get('emi_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\EducationalMethodicalItems $eduMethItemsRep */
        $eduMethItemsRep = $this->getRepository('BSUIRIndividualPlanBundle:EducationalMethodicalItems');
        $eduMethItem = $eduMethItemsRep->findOneByIdAndProfessor($eduMethItemId, $professor);

        if (null === $eduMethItem) {
            // TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $form = $this->createForm(new EducationalMethodicalItemsType(), $eduMethItem);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getManager();
            try {
                $em->persist($eduMethItem);
                $em->flush();
            } catch(\Exception $e) {
                //TODO: set error message
                die($e->getMessage());
            }

            return $this->redirect($this->generateUrl('educational_methodical_work_update', array(
                'emw_id' => $eduMethItem->getEducationalMethodicalWork()->getId(),
            )));
        }

        return $this->render('BSUIRIndividualPlanBundle:EducationalMethodicalItems:update.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function removeAction(Request $request)
    {
        $professor = $this->getUser();
        $eduMethItemId = $request->get('emi_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\EducationalMethodicalItems $eduMethItemsRep */
        $eduMethItemsRep = $this->getRepository('BSUIRIndividualPlanBundle:EducationalMethodicalItems');
        $eduMethItem = $eduMethItemsRep->findOneByIdAndProfessor($eduMethItemId, $professor);

        if (null === $eduMethItem) {
            // TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $eduMethWorkId = $eduMethItem->getEducationalMethodicalWork()->getId();
        $em = $this->getManager();
        try {
            $em->remove($eduMethItem);
            $em->flush();
        } catch(\Exception $e) {
            //TODO: set error message
            die($e->getMessage());
        }

        return $this->redirect($this->generateUrl('educational_methodical_work_update', array(
            'emw_id' => $eduMethWorkId,
        )));

    }
}