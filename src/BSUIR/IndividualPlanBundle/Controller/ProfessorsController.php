<?php
namespace BSUIR\IndividualPlanBundle\Controller;

use BSUIR\IndividualPlanBundle\Form\Type\EditProfessorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BSUIR\IndividualPlanBundle\Form\Type\RegistrationType;
use BSUIR\IndividualPlanBundle\Form\Model\Registration;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class ProfessorsController extends Controller
{
    /**
     * registration form
     */
    public function registerAction(Request $request)
    {
        $registration = new Registration();
        $form = $this->createForm(new RegistrationType(), $registration);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var \BSUIR\IndividualPlanBundle\Entity\Professors $professor */
            $professor = $registration->getProfessors();
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($professor);
            $password = $encoder->encodePassword($registration->getPassword(), $professor->getSalt());
            $professor->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            try{
                $em->persist($professor);
                $em->flush();

                $token = new UsernamePasswordToken($professor, null, 'local', $professor->getRoles());
                $this->get('security.context')->setToken($token);
                $this->get('session')->set('_security_secured_area',serialize($token));
                return $this->redirect($this->generateUrl('bsuir_individual_plan_homepage'));
            } catch( \Exception $e) {
                $this->get('session')->getFlashBag()->set('error', $e->getMessage());
            }
        }

        if ($form->getErrors()) {
            foreach ($form->getErrors() as $error) {
                $this->get('session')->getFlashBag()->set('error', $error->getMessage());
            }
        }


        return $this->render('BSUIRIndividualPlanBundle:Professors:register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * edit professor form
     */
    public function editAction(Request $request)
    {
        $professor = $this->getUser();
        $registration = new Registration();
        $registration->setProfessors($professor);
        $form = $this->createForm(new EditProfessorType(), $registration);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var \BSUIR\IndividualPlanBundle\Entity\Professors $professor */
            $professor = $registration->getProfessors();

            if ($registration->getPassword()) {
                var_dump($registration->getPassword());
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($professor);
                $password = $encoder->encodePassword($registration->getPassword(), $professor->getSalt());
                $professor->setPassword($password);
            }

            $em = $this->getDoctrine()->getManager();
            try{
                $em->persist($professor);
                $em->flush();
                $this->get('session')->getFlashBag()->set('success', 'Пользователь успешно обновлён!');
            } catch( \Exception $e) {
                $this->get('session')->getFlashBag()->set('error', 'Что-то пошло нетак.');
            }

            return $this->redirect($this->generateUrl('professors_edit'));
        }

        return $this->render('BSUIRIndividualPlanBundle:Professors:edit.html.twig',
            array('form' => $form->createView())
        );
    }
}

