<?php

namespace Hotel\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReservationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('startReservation', 'datetime', array('date_widget' => "single_text", 'time_widget' => "single_text"))
            ->add('endReservation', 'datetime', array('date_widget' => "single_text", 'time_widget' => "single_text"))
            ->add('services', 'choice', array(
                'choices' => array(
                    'service'  => array('breakfast', 'lunch', 'dinner'),
                ),
                'multiple' => true,
                'expanded' => false
            ))
            ->add('room', 'entity', array('class' => 'Hotel\AdminBundle\Entity\Room','label' => 'Room: ', 'property' => 'roomNumber'))
            ->add('user', 'entity', array('class' => 'Hotel\AdminBundle\Entity\User','label' => 'Client: ', 'property' => 'email'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Hotel\AdminBundle\Entity\Reservation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hotel_adminbundle_reservation';
    }
}
