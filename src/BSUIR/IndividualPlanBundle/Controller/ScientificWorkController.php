<?php

namespace BSUIR\IndividualPlanBundle\Controller;

use BSUIR\IndividualPlanBundle\Entity\ScientificWork;
use BSUIR\IndividualPlanBundle\Form\Type\ScientificWorkType;
use Symfony\Component\HttpFoundation\Request;

class ScientificWorkController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('BSUIRIndividualPlanBundle:ScientificWork:index.html.twig');
    }

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

        $scWork = new ScientificWork();
        $form = $this->createForm(new ScientificWorkType(), $scWork);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getManager();

            try{
                $em->persist($scWork);
                $individualPlan->setScientificWork($scWork);
                $em->persist($individualPlan);
                $em->flush();
            } catch (\Exception $e) {
                die($e->getMessage());
            }

            return $this->redirect($this->generateUrl('scientific_work_update', array(
                'sw_id' => $scWork->getId(),
            )));
        }

        return $this->render('BSUIRIndividualPlanBundle:ScientificWork:create.html.twig', array(
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
        $scWorkId = (int) $request->get('sw_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\ScientificWork $scWorkRep */
        $scWorkRep = $this->getRepository('BSUIRIndividualPlanBundle:ScientificWork');
        /** @var ScientificWork $sw */
        $scWork = $scWorkRep->findOneByIdAndProfessor($scWorkId, $professor);

        if (null === $scWork) {
            //TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $form = $this->createForm(new ScientificWorkType(), $scWork);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getManager();

            try{
                $em->persist($scWork);
                $em->flush();
            } catch (\Exception $e) {
                die($e->getMessage());
            }

            return $this->redirect($this->generateUrl('scientific_work_update', array(
                'sw_id' => $scWork->getId(),
            )));
        }

        $scItems = $this
            ->getRepository('BSUIRIndividualPlanBundle:ScientificItems')
            ->findBy(array(
                'scientificWork' => $scWork->getId(),
            ));

        return $this->render('BSUIRIndividualPlanBundle:ScientificWork:update.html.twig', array(
            'form' => $form->createView(),
            'scWork' => $scWork,
            'scItems' => $scItems,
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction(Request $request)
    {
        $professor = $this->getUser();
        $scWorkId = (int) $request->get('sw_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\ScientificWork $scWorkRep */
        $scWorkRep = $this->getRepository('BSUIRIndividualPlanBundle:ScientificWork');
        /** @var ScientificWork $scWork */
        $scWork = $scWorkRep->findOneByIdAndProfessor($scWorkId, $professor);

        if (null === $scWork) {
            //TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $individualPlanId = $scWork->getIndividualPlan()->getId();
        $em = $this->getManager();
        try{
            $em->remove($scWork);
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
        $scWorkId = (int) $request->get('sw_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\ScientificWork $scWorkRep */
        $scWorkRep = $this->getRepository('BSUIRIndividualPlanBundle:ScientificWork');
        /** @var ScientificWork $sw */
        $scWork = $scWorkRep->findOneByIdAndProfessor($scWorkId, $professor);

        if (null === $scWork) {
            //TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $scItems = $this
            ->getRepository('BSUIRIndividualPlanBundle:ScientificItems')
            ->findBy(array(
                'scientificWork' => $scWork->getId(),
            ));

        return $this->render('BSUIRIndividualPlanBundle:ScientificWork:print.html.twig', array(
            'scWork' => $scWork,
            'scItems' => $scItems,
        ));
    }
}