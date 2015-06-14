<?php

namespace BSUIR\IndividualPlanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditProfessorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('professors', new ProfessorsType())
            ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'Пароль не подтверждён, повторите попытку.',
                    'first_name' => 'password',
                    'second_name' => 'confirm',
                    'first_options'  => array('label' => 'Пароль'),
                    'second_options' => array('label' => 'Подтвердите пароль'),
                    'error_bubbling' => true,
                    'required' => false,
                )
            )
            ->add('edit', 'submit', array(
                'label' => 'Редактировать',
            ));

        return true;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups'  => array('edit_professor')
        ));
    }

    public function getName()
    {
        return 'edit_professor';
    }
}