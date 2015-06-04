<?php

namespace BSUIR\IndividualPlanBundle\Form\Type;

use BSUIR\IndividualPlanBundle\Entity\EducationWorkPlan;
use BSUIR\IndividualPlanBundle\Entity\EducationWorkPlanItems;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EducationWorkPlanItemsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('groups', 'entity', array(
                'class' => 'BSUIRIndividualPlanBundle:Groups',
                'property' => 'name',
                'multiple' => true,
                'required' => true,
            ))
            ->add('discipline', 'entity', array(
                'class' => 'BSUIRIndividualPlanBundle:Disciplines',
                'property' => 'name',
                'required' => true,
            ))
            ->add('months', 'choice', array(
                'required' => true,
                'choices' => EducationWorkPlanItems::getMonthsBySemester($options['semester']),
                'multiple' => true,
            ))
            ->add('lectures', 'text', array('required' => false, 'label' => ''))
            ->add('practicalLessons', 'text', array('required' => false, 'label' => ''))
            ->add('labs', 'text', array('required' => false, 'label' => ''))
            ->add('courseWork', 'text', array('required' => false, 'label' => ''))
            ->add('sampleCalculation', 'text', array('required' => false, 'label' => ''))
            ->add('calculationWork', 'text', array('required' => false, 'label' => ''))
            ->add('individualPracticalWork', 'text', array('required' => false, 'label' => ''))
            ->add('consultations', 'text', array('required' => false, 'label' => ''))
            ->add('assessment', 'text', array('required' => false, 'label' => ''))
            ->add('exams', 'text', array('required' => false, 'label' => ''))
            ->add('reviews', 'text', array('required' => false, 'label' => ''))
            ->add('controlIndependentWork', 'text', array('required' => false, 'label' => ''))
            ->add('educationPractice', 'text', array('required' => false, 'label' => ''))
            ->add('technologicalPractice', 'text', array('required' => false, 'label' => ''))
            ->add('prediplomaPractice', 'text', array('required' => false, 'label' => ''))
            ->add('diplomaDesign', 'text', array('required' => false, 'label' => ''))
            ->add('gakConsultations', 'text', array('required' => false, 'label' => ''))
            ->add('gakWorkCommission', 'text', array('required' => false, 'label' => ''))
            ->add('gakProducingDepartment', 'text', array('required' => false, 'label' => ''))
            ->add('gakExpert', 'text', array('required' => false, 'label' => ''))
            ->add('controlHighStudents', 'text', array('required' => false, 'label' => ''))
            ->add('checkHighStudents', 'text', array('required' => false, 'label' => ''))
            ->add('controlGraduate', 'text', array('required' => false, 'label' => ''))
            ->add('dropWeight', 'text', array('required' => false, 'label' => ''))
            ->add('note', 'textarea', array('required' => false, 'label' => ''))
            ->add('create', 'submit');

        return true;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefined('semester');

        $resolver->setDefaults(array(
            'data_class'         => 'BSUIR\IndividualPlanBundle\Entity\EducationWorkPlanItems',
            'validation_groups'  => array('educationWorkPlanItems')
        ));
    }

    public function getName()
    {
        return 'educationWorkPlanItems';
    }
}