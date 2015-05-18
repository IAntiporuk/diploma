<?php

namespace BSUIR\IndividualPlanBundle\Controller;

use BSUIR\IndividualPlanBundle\Entity\ScientificItems;
use BSUIR\IndividualPlanBundle\Form\Type\ScientificItemsType;
use Symfony\Component\HttpFoundation\Request;

class ScientificItemsController extends BaseController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $professor = $this->getUser();
        $scWorkId = (int) $request->get('sw_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\ScientificWork $scWorkRep */
        $scWorkRep = $this->getRepository('BSUIRIndividualPlanBundle:ScientificWork');
        $scWork = $scWorkRep->findOneByIdAndProfessor($scWorkId, $professor);

        if (null === $scWork) {
            // TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $scItem = new ScientificItems();
        $form = $this->createForm(new ScientificItemsType(), $scItem);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getManager();
            $scItem->setScientificWork($scWork);
            try {
                $em->persist($scItem);
                $em->flush();
            } catch(\Exception $e) {
                //TODO: set error message
                die($e->getMessage());
            }

            return $this->redirect($this->generateUrl('scientific_work_update', array(
                'sw_id' => $scWorkId,
            )));
        }

        return $this->render('BSUIRIndividualPlanBundle:ScientificItems:create.html.twig', array(
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
        $scItemId = (int) $request->get('si_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\ScientificItems $scItemsRep */
        $scItemsRep = $this->getRepository('BSUIRIndividualPlanBundle:EducationalMethodicalItems');
        $scItem = $scItemsRep->findOneByIdAndProfessor($scItemId, $professor);

        if (null === $scItem) {
            // TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $form = $this->createForm(new ScientificItemsType(), $scItem);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getManager();
            try {
                $em->persist($scItem);
                $em->flush();
            } catch(\Exception $e) {
                //TODO: set error message
                die($e->getMessage());
            }

            return $this->redirect($this->generateUrl('scientific_work_update', array(
                'sw_id' => $scItem->getScientificWork()->getId(),
            )));
        }

        return $this->render('BSUIRIndividualPlanBundle:ScientificItems:update.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function removeAction(Request $request)
    {
        $professor = $this->getUser();
        $scItemId = (int) $request->get('si_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\ScientificItems $scItemsRep */
        $scItemsRep = $this->getRepository('BSUIRIndividualPlanBundle:ScientificItems');
        $scItem = $scItemsRep->findOneByIdAndProfessor($scItemId, $professor);

        if (null === $scItem) {
            // TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $scWorkId = $scItem->getScientificWork()->getId();
        $em = $this->getManager();
        try {
            $em->remove($scItem);
            $em->flush();
        } catch(\Exception $e) {
            //TODO: set error message
            die($e->getMessage());
        }

        return $this->redirect($this->generateUrl('scientific_work_update', array(
            'sw_id' => $scWorkId,
        )));

    }
}