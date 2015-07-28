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
                'expanded' => true
            ))

            ->add('peopleOfRoom', 'choice', array(
                'choices' => array('1' => '1', '2' => '2', '3' => '3'),
                'multiple' => false,
                'expanded' => false
            ))
            ->add('submit', 'submit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Hotel\AdminBundle\Entity\Reservation'
        ));
    }

    public function getName()
    {
        return 'hotel_front_bundle_make_reservation';
    }
}
