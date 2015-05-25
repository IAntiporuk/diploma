<?php

namespace BSUIR\IndividualPlanBundle\Controller;

use BSUIR\IndividualPlanBundle\Entity\OtherItems;
use BSUIR\IndividualPlanBundle\Form\Type\OtherItemsType;
use Symfony\Component\HttpFoundation\Request;

class OtherItemsController extends BaseController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $professor = $this->getUser();
        $otherWorkId = (int) $request->get('ow_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\OtherWork $otherWorkRep */
        $otherWorkRep = $this->getRepository('BSUIRIndividualPlanBundle:OtherWork');
        $otherWork = $otherWorkRep->findOneByIdAndProfessor($otherWorkId, $professor);

        if (null === $otherWork) {
            // TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $otherItem = new OtherItems();
        $form = $this->createForm(new OtherItemsType(), $otherItem);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getManager();
            $otherItem->setOtherWork($otherWork);
            try {
                $em->persist($otherItem);
                $em->flush();
            } catch(\Exception $e) {
                //TODO: set error message
                die($e->getMessage());
            }

            return $this->redirect($this->generateUrl('other_work_update', array(
                'ow_id' => $otherWorkId,
            )));
        }

        return $this->render('BSUIRIndividualPlanBundle:OtherItems:create.html.twig', array(
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
        $otherItemId = (int) $request->get('oi_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\OtherItems $otherItemsRep */
        $otherItemsRep = $this->getRepository('BSUIRIndividualPlanBundle:OtherItems');
        $otherItem = $otherItemsRep->findOneByIdAndProfessor($otherItemId, $professor);

        if (null === $otherItem) {
            // TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $form = $this->createForm(new OtherItemsType(), $otherItem);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getManager();
            try {
                $em->persist($otherItem);
                $em->flush();
            } catch(\Exception $e) {
                //TODO: set error message
                die($e->getMessage());
            }

            return $this->redirect($this->generateUrl('other_work_update', array(
                'ow_id' => $otherItem->getOtherWork()->getId(),
            )));
        }

        return $this->render('BSUIRIndividualPlanBundle:OtherItems:update.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function removeAction(Request $request)
    {
        $professor = $this->getUser();
        $otherItemId = (int) $request->get('oi_id');

        /** @var \BSUIR\IndividualPlanBundle\Repository\OtherItems $otherItemsRep */
        $otherItemsRep = $this->getRepository('BSUIRIndividualPlanBundle:OtherItems');
        $otherItem = $otherItemsRep->findOneByIdAndProfessor($otherItemId, $professor);

        if (null === $otherItem) {
            // TODO: set error message
            return $this->redirect($this->generateUrl('individual_plan_index'));
        }

        $otherWorkId = $otherItem->getOtherWork()->getId();
        $em = $this->getManager();
        try {
            $em->remove($otherItem);
            $em->flush();
        } catch(\Exception $e) {
            //TODO: set error message
            die($e->getMessage());
        }

        return $this->redirect($this->generateUrl('other_work_update', array(
            'ow_id' => $otherWorkId,
        )));

    }
}