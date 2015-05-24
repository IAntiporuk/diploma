<?php

namespace BSUIR\IndividualPlanBundle\Controller;

use BSUIR\IndividualPlanBundle\Entity\OtherWork;
use Symfony\Component\HttpFoundation\Request;

class OtherWorkController extends BaseController
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

        $otherWork = new OtherWork();
        $em = $this->getManager();

        try{
            $em->persist($otherWork);
            $individualPlan->setOtherWork($otherWork);
            $em->persist($individualPlan);
            $em->flush();
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $this->redirect($this->generateUrl('other_work_update', array(
            'ow_id' => $otherWork->getId(),
        )));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request)
    {
        $professor = $this->getUser();
        $otherWorkId = (int) $request->get('ow_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\OtherWork $otherWorkRep */
        $otherWorkRep = $this->getRepository('BSUIRIndividualPlanBundle:OtherWork');
        /** @var OtherWork $sw */
        $otherWork = $otherWorkRep->findOneByIdAndProfessor($otherWorkId, $professor);

        if (null === $otherWork) {
            //TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $otherItems = $this
            ->getRepository('BSUIRIndividualPlanBundle:OtherItems')
            ->findBy(array(
                'otherWork' => $otherWork->getId(),
            ));

        return $this->render('BSUIRIndividualPlanBundle:OtherWork:update.html.twig', array(
            'otherWork' => $otherWork,
            'otherItems' => $otherItems,
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction(Request $request)
    {
        $professor = $this->getUser();
        $otherWorkId = (int) $request->get('ow_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\OtherWork $otherWorkRep */
        $otherWorkRep = $this->getRepository('BSUIRIndividualPlanBundle:OtherWork');
        /** @var OtherWork $sw */
        $otherWork = $otherWorkRep->findOneByIdAndProfessor($otherWorkId, $professor);

        if (null === $otherWork) {
            //TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $individualPlanId = $otherWork->getIndividualPlan()->getId();
        $em = $this->getManager();
        try{
            $em->remove($otherWork);
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
        $otherWorkId = (int) $request->get('ow_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\OtherWork $otherWorkRep */
        $otherWorkRep = $this->getRepository('BSUIRIndividualPlanBundle:OtherWork');
        /** @var OtherWork $sw */
        $otherWork = $otherWorkRep->findOneByIdAndProfessor($otherWorkId, $professor);

        if (null === $otherWork) {
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