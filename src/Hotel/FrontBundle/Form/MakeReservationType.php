<?php

namespace Hotel\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MakeReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('startReservation', 'datetime', array('widget' => 'single_text', 'html5' => false, 'format' => 'yyyy-MM-dd',))
            ->add('endReservation', 'datetime', array('widget' => 'single_text', 'html5' => false, 'format' => 'yyyy-MM-dd',))
            ->add('services', 'choice', array(
                'choices' => array(
                    'service'  => array('breakfast', 'lunch', 'dinner'),
                ),
                'multiple' => true,
                'expanded' => false
            ))
            ->add('peopleOfRoom', 'number', array(

            ))
            ->add('submit', 'submit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'hotel_front_bundle_make_reservation';
    }
}
