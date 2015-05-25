<?php

namespace BSUIR\IndividualPlanBundle\Controller;

use BSUIR\IndividualPlanBundle\Entity\EducationalMethodicalWork;
use BSUIR\IndividualPlanBundle\Form\Type\EducationalMethodicalWorkType;
use Symfony\Component\HttpFoundation\Request;

class EducationalMethodicalWorkController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('BSUIRIndividualPlanBundle:EducationalMethodicalWork:index.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $individualPlanId = $request->get('ip_id');
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

        $eduMethWork = new EducationalMethodicalWork();
        $em = $this->getManager();

        try{
            $em->persist($eduMethWork);
            $individualPlan->setEducationalMethodicalWork($eduMethWork);
            $em->persist($individualPlan);
            $em->flush();
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $this->redirect($this->generateUrl('educational_methodical_work_update', array(
            'emw_id' => $eduMethWork->getId(),
        )));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request)
    {
        $professor = $this->getUser();

        /** @var \BSUIR\IndividualPlanBundle\Repository\EducationalMethodicalWork $eduMethWorkRep */
        $eduMethWorkRep = $this->getRepository('BSUIRIndividualPlanBundle:EducationalMethodicalWork');
        /** @var EducationalMethodicalWork $eduMethWork */
        $eduMethWork = $eduMethWorkRep->findOneByIdAndProfessor($request->get('emw_id'), $professor);

        if (null === $eduMethWork) {
            //TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $eduMethItems = $this
            ->getRepository('BSUIRIndividualPlanBundle:EducationalMethodicalItems')
            ->findBy(array(
                'educationalMethodicalWork' => $eduMethWork->getId(),
            ));

        return $this->render('BSUIRIndividualPlanBundle:EducationalMethodicalWork:update.html.twig', array(
            'emw' => $eduMethWork,
            'emi' => $eduMethItems,
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction(Request $request)
    {
        $professor = $this->getUser();

        /** @var \BSUIR\IndividualPlanBundle\Repository\EducationalMethodicalWork $eduMethWorkRep */
        $eduMethWorkRep = $this->getRepository('BSUIRIndividualPlanBundle:EducationalMethodicalWork');
        /** @var EducationalMethodicalWork $eduMethWork */
        $eduMethWork = $eduMethWorkRep->findOneByIdAndProfessor($request->get('emw_id'), $professor);

        if (null === $eduMethWork) {
            //TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $individualPlanId = $eduMethWork->getIndividualPlan()->getId();
        $em = $this->getManager();
        try{
            $em->remove($eduMethWork);
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

        /** @var \BSUIR\IndividualPlanBundle\Repository\EducationalMethodicalWork $eduMethWorkRep */
        $eduMethWorkRep = $this->getRepository('BSUIRIndividualPlanBundle:EducationalMethodicalWork');
        /** @var EducationalMethodicalWork $eduMethWork */
        $eduMethWork = $eduMethWorkRep->findOneByIdAndProfessor($request->get('emw_id'), $professor);

        if (null === $eduMethWork) {
            //TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $eduMethItems = $this
            ->getRepository('BSUIRIndividualPlanBundle:EducationalMethodicalItems')
            ->findBy(array(
                'educationalMethodicalWork' => $eduMethWork->getId(),
            ));

        return $this->render('BSUIRIndividualPlanBundle:EducationalMethodicalWork:print.html.twig', array(
            'emw' => $eduMethWork,
            'emi' => $eduMethItems,
        ));
    }
}