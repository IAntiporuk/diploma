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
                'label' => 'Название работ'
            ))
            ->add('startedAt', 'collot_datetime', array(
                'label' => 'Начало',
                'pickerOptions' =>
                    array(
                        'format' => 'mm/dd/yyyy',
                        'startView' => 'month',
                        'minView' => 'month',
                        'language' => 'ru',
                    ),
                'required' => true,
            ))
            ->add('finishedAt', 'collot_datetime', array(
                'label' => 'Конец',
                'pickerOptions' =>
                    array(
                        'format' => 'mm/dd/yyyy',
                        'startView' => 'month',
                        'minView' => 'month',
                        'language' => 'ru',
                    ),
                'required' => true,
            ))
            ->add('markFirst', 'text', array(
                'required' => false,
                'label' => 'Отметка зав. кафедры о выполнении на 30.12',
            ))
            ->add('markSecond', 'text', array(
                'required' => false,
                'label' => 'Отметка зав. кафедры о выполнении на 01.07',
            ))
            ->add('note', 'textarea', array(
                'required' => false,
                'label' => 'Примечаниу',
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