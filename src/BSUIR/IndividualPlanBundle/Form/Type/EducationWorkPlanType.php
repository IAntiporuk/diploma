<?php

namespace BSUIR\IndividualPlanBundle\Form\Type;

use BSUIR\IndividualPlanBundle\Entity\EducationWorkPlan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EducationWorkPlanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('semester', 'choice', array(
                'choices' => EducationWorkPlan::getSemesters(),
                'required' => true,
                'label' => 'Семестр',
            ))
            ->add('create', 'submit');

        return true;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'BSUIR\IndividualPlanBundle\Entity\EducationWorkPlan',
            'validation_groups'  => array('educationWorkPlan')
        ));
    }

    public function getName()
    {
        return 'educationWorkPlan';
    }
}