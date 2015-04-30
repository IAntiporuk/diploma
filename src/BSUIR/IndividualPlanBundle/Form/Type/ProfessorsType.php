<?php

namespace BSUIR\IndividualPlanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfessorsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text', array('required' => true))
            ->add('secondName', 'text', array('required' => true))
            ->add('lastName', 'text', array('required' => true))
            ->add('department', 'entity', array(
                'required' => true,
                'class' => 'BSUIRIndividualPlanBundle:Departments',
                'property' => 'name',
            ))
            ->add('email', 'email', array('required' => true))
            ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'Password is not confirmed.',
                    'first_name' => 'password',
                    'second_name' => 'confirm',
                    'error_bubbling' => true,
                    'required' => true
                )
            )
            ->add('academicTitle', 'text', array('required' => true))
            ->add('scholasticDegree', 'text', array('required' => true))
            ->add('competitionSelected', 'date', array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'required' => true,
            ))
            ->add('sign_up', 'submit');
        return true;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'BSUIR\IndividualPlanBundle\Entity\Professors',
            'validation_groups'  => array('registration')
        ));
    }

    public function getName()
    {
        return 'professors';
    }
}