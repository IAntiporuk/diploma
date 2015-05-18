<?php

namespace BSUIR\IndividualPlanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EducationalMethodicalItemsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('workName', 'text', array(
                'required' => true,
            ))
            ->add('startedAt', 'date', array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'required' => false,
            ))
            ->add('finishedAt', 'date', array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'required' => false,
            ))
            ->add('markFirst', 'text', array(
                'required' => false,
            ))
            ->add('markSecond', 'text', array(
                'required' => false,
            ))
            ->add('note', 'textarea', array(
                'required' => false,
            ))
            ->add('create', 'submit', array(
                'label' => 'Создать'
            ));

        return true;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'BSUIR\IndividualPlanBundle\Entity\EducationalMethodicalItems',
            'validation_groups'  => array('educationalMethodicalItems')
        ));
    }

    public function getName()
    {
        return 'educationalMethodicalItems';
    }
}