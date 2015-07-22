<?php

namespace Hotel\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class searchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search', 'text', array(
            ''
            ))
            ->add('howManyRooms', 'choice', array(
                'choices' => array('1' => '1', '2' => '2', '3' => '3'),
                'preferred_choices' => array('1')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'hotel_admin_bundlesearch_type';
    }
}
