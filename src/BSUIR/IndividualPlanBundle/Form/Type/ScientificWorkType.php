<?php

namespace BSUIR\IndividualPlanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ScientificWorkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('topicName', 'text', array(
                'required' => true,
            ))
            ->add('partName', 'text', array(
                'required' => true,
            ))
            ->add('create', 'submit');

        return true;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'BSUIR\IndividualPlanBundle\Entity\ScientificWork',
            'validation_groups'  => array('scientificWork')
        ));
    }

    public function getName()
    {
        return 'scientificWork';
    }
}