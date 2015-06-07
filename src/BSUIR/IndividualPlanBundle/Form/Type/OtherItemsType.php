<?php

namespace BSUIR\IndividualPlanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OtherItemsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('work', 'text', array(
                'required' => true,
                'label' => 'Выполняемая работа',
            ))
            ->add('mark', 'text', array(
                'required' => false,
                'label' => 'Отметка о выполнении',
            ))
            ->add('create', 'submit', array(
                'label' => 'Создать'
            ));

        return true;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'BSUIR\IndividualPlanBundle\Entity\OtherItems',
            'validation_groups'  => array('scientificItems')
        ));
    }

    public function getName()
    {
        return 'otherItems';
    }
}