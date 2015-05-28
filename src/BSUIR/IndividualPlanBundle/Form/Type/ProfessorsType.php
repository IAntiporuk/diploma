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
            ->add('firstName', 'text', array('required' => true, 'label' => 'Имя'))
            ->add('secondName', 'text', array('required' => true, 'label' => 'Отчество'))
            ->add('lastName', 'text', array('required' => true, 'label' => 'Фамилия'))
            ->add('department', 'entity', array(
                'required' => true,
                'class' => 'BSUIRIndividualPlanBundle:Departments',
                'property' => 'name',
                'label' => 'Кафедра',
            ))
            ->add('email', 'email', array('required' => true,))
            ->add('academicTitle', 'text', array('required' => true, 'label' => 'Учёнок звание'))
            ->add('scholasticDegree', 'text', array('required' => true, 'label' => 'Учёная степень'))
            ->add('competitionSelected', 'date', array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'required' => true,
                'label' => 'Избран по конкурсу',
            ))
            ->add('isHead', 'checkbox', array(
                'required' => false,
                'label' => 'Зав. кафедры'
            ));

        return true;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'BSUIR\IndividualPlanBundle\Entity\Professors',
            'validation_groups'  => array('professors')
        ));
    }

    public function getName()
    {
        return 'professors';
    }
}