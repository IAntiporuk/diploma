<?php

namespace BSUIR\IndividualPlanBundle\Controller;

use BSUIR\IndividualPlanBundle\Entity\EducationWorkPlan;
use BSUIR\IndividualPlanBundle\Entity\EducationWorkPlanItems;
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

                return $this->redirect($this->generateUrl('education_work_plan_update', array(
                    'ewp_id' => $educationWorkPlan->getId(),
                )));
            } catch (\Exception $e) {
                $this->get('session')->getFlashBag()->set('error', 'Выберете другой семестр.');
            }
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
        $ewp = $this->getEWP($request);

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
                $this->get('session')->getFlashBag()->set('error', 'Выберете другой семестр.');
            }
        }

        $ewpi = $this
            ->getRepository('BSUIRIndividualPlanBundle:EducationWorkPlanItems')
            ->findBy(array(
                'educationWorkPlan' => $ewp->getId(),
            ));

        return $this->render('BSUIRIndividualPlanBundle:EducationWorkPlan:update.html.twig', array(
            'ewp' => $ewp,
            'form' => $form->createView(),
            'ewpi' => $ewpi,
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction(Request $request)
    {
        $ewp = $this->getEWP($request);

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
        $ewp = $this->getEWP($request);

        if (null === $ewp) {
            //TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $ewpiRepo = $this->getRepository('BSUIRIndividualPlanBundle:EducationWorkPlanItems');
        $ewpi = $ewpiRepo->findBy(array(
                'educationWorkPlan' => $ewp,
            ));

        return $this->render('BSUIRIndividualPlanBundle:EducationWorkPlan:print.html.twig', array(
            'ewpi' => $ewpi,
            'ewp' => $ewp,
            'ewpRepo' => $ewpiRepo,
            'sumFields' => EducationWorkPlanItems::getEducationWorkFields(),
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function printMonthAction(Request $request)
    {
        $ewp = $this->getEWP($request);

        if (null === $ewp) {
            //TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $ewpiRepo = $this->getRepository('BSUIRIndividualPlanBundle:EducationWorkPlanItems');

        $moths = EducationWorkPlanItems::getMonthsBySemester($ewp->getSemester());
        $mothsItems = array();
        foreach ($moths as $key => $month) {
            $mothsItems[$month] = $ewpiRepo->findByMonth($ewp, $key);
        }

        return $this->render('BSUIRIndividualPlanBundle:EducationWorkPlan:printMonth.html.twig', array(
            'mothsItems' => $mothsItems,
            'ewp' => $ewp,
            'ewpRepo' => $ewpiRepo,
            'sumFields' => EducationWorkPlanItems::getEducationWorkFields(),
        ));
    }

    /**
     * @param Request $request
     * @return EducationWorkPlan
     */
    protected function getEWP(Request $request)
    {
        $professor = $this->getUser();
        $ewpId = (int) $request->get('ewp_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\EducationWorkPlan $ewpRep */
        $ewpRep = $this->getRepository('BSUIRIndividualPlanBundle:EducationWorkPlan');
        /** @var EducationWorkPlan $ewp */
        return $ewpRep->findOneByIdAndProfessor($ewpId, $professor);
    }
}