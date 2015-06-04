<?php

namespace BSUIR\IndividualPlanBundle\Controller;

use BSUIR\IndividualPlanBundle\Entity\EducationWorkPlanItems;
use BSUIR\IndividualPlanBundle\Form\Type\EducationWorkPlanItemsType;
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
        $form = $this->createForm(new EducationWorkPlanItemsType(), $ewpi, array(
            'semester' => $ewp->getSemester(),
        ));
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
        $ewpi = $this->getEWPI($request);

        if (null === $ewpi) {
            // TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $form = $this->createForm(new EducationWorkPlanItemsType(), $ewpi, array(
            'semester' => $ewpi->getEducationWorkPlan()->getSemester(),
        ));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getManager();
            try {
                $em->persist($ewpi);
                $em->flush();
            } catch(\Exception $e) {
                //TODO: set error message
                die($e->getMessage());
            }

            return $this->redirect($this->generateUrl('education_work_plan_update', array(
                'ewp_id' => $ewpi->getEducationWorkPlan()->getId(),
            )));
        }

        return $this->render('BSUIRIndividualPlanBundle:EducationWorkPlanItems:update.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function removeAction(Request $request)
    {
        $ewpi = $this->getEWPI($request);

        if (null === $ewpi) {
            // TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $ewp = $ewpi->getEducationWorkPlan()->getId();
        $em = $this->getManager();
        try {
            $em->remove($ewpi);
            $em->flush();
        } catch(\Exception $e) {
            //TODO: set error message
            die($e->getMessage());
        }

        return $this->redirect($this->generateUrl('education_work_plan_update', array(
            'ewp_id' => $ewp,
        )));
    }

    protected function getEWPI(Request $request)
    {
        $professor = $this->getUser();
        $ewpiId = $request->get('ewpi_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\EducationWorkPlanItems $ewpiRep */
        $ewpiRep = $this->getRepository('BSUIRIndividualPlanBundle:EducationWorkPlanItems');

        return $ewpiRep->findOneByIdAndProfessor($ewpiId, $professor);
    }
}