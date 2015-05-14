<?php

namespace BSUIR\IndividualPlanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IndividualPlansType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('session', 'choice', array(
                'choices' => $this->getDateRange(),
                'required' => true,
                'label' => 'Учебный год:',
            ))
            ->add('create', 'submit', array(
                'label' => 'Создать'
            ));

        return true;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'BSUIR\IndividualPlanBundle\Entity\IndividualPlans',
            'validation_groups'  => array('individualPlans')
        ));
    }

    public function getName()
    {
        return 'individualPlans';
    }

    private function getDateRange()
    {
        $now = date('Y', time());
        $last = $now + 5;
        $rage = array();

        for($now; $now < $last; $now++) {
            $rage[$now] = $now . '-';
            $rage[$now] .= $now + 1;
        }

        return $rage;
    }
}