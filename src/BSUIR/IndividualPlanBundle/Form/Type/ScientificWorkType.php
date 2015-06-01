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
                'label' => 'Название научно-исследовательской темы, задания по сотрудничеству с промышленностью или задания по внедрению выполненных работ и т.д.'
            ))
            ->add('partName', 'text', array(
                'required' => true,
                'label' => 'Название раздела, который выполняется в этом году'
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