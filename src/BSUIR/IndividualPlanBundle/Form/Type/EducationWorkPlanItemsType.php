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
                'label' => 'Группы',
            ))
            ->add('discipline', 'entity', array(
                'class' => 'BSUIRIndividualPlanBundle:Disciplines',
                'property' => 'name',
                'required' => true,
                'label' => 'Название дисциплины'
            ))
            ->add('months', 'choice', array(
                'required' => true,
                'choices' => EducationWorkPlanItems::getMonthsBySemester($options['semester']),
                'multiple' => true,
                'label' => 'Месяцы',
            ))
            ->add('lectures', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('lectures')))
            ->add('practicalLessons', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('practicalLessons')))
            ->add('labs', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('labs')))
            ->add('courseWork', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('courseWork')))
            ->add('sampleCalculation', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('sampleCalculation')))
            ->add('calculationWork', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('calculationWork')))
            ->add('individualPracticalWork', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('individualPracticalWork')))
            ->add('consultations', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('consultations')))
            ->add('assessment', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('assessment')))
            ->add('exams', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('exams')))
            ->add('reviews', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('reviews')))
            ->add('controlIndependentWork', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('controlIndependentWork')))
            ->add('educationPractice', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('educationPractice')))
            ->add('technologicalPractice', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('technologicalPractice')))
            ->add('prediplomaPractice', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('prediplomaPractice')))
            ->add('diplomaDesign', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('diplomaDesign')))
            ->add('gakConsultations', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('gakConsultations')))
            ->add('gakWorkCommission', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('gakWorkCommission')))
            ->add('gakProducingDepartment', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('gakProducingDepartment')))
            ->add('gakExpert', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('gakExpert')))
            ->add('controlHighStudents', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('controlHighStudents')))
            ->add('checkHighStudents', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('checkHighStudents')))
            ->add('controlGraduate', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('controlGraduate')))
            ->add('dropWeight', 'text', array('required' => false, 'label' => EducationWorkPlanItems::getEducationWorkField('dropWeight')))
            ->add('note', 'textarea', array('required' => false, 'label' => 'Примечание'))
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