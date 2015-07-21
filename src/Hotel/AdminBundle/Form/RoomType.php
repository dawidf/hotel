<?php

namespace Hotel\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoomType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numberOfPeople')
            ->add('forSmokingPeople', null, array(
                'required' => false
            ))
            ->add('roomNumber')
            ->add('floor', 'entity', array('class' => 'Hotel\AdminBundle\Entity\Floor','label' => 'Floor: ', 'property' => 'floor'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Hotel\AdminBundle\Entity\Room'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hotel_adminbundle_room';
    }
}
