<?php

namespace BSUIR\IndividualPlanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('professors', new ProfessorsType())
            ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'Password is not confirmed.',
                    'first_name' => 'password',
                    'second_name' => 'confirm',
                    'error_bubbling' => true,
                    'required' => true
                )
            )
            ->add('sign_up', 'submit');
        return true;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups'  => array('registration')
        ));
    }

    public function getName()
    {
        return 'registration';
    }
}