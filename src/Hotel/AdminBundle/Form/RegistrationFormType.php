<?php

namespace Hotel\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('surname')
            ->add('adress')
            ->add('postalCode')
            ->add('city')
            ->add('phoneNumber')
        ;
    }


    public function getParent()
    {
        return 'fos_user_registration';
    }
    public function getName()
    {
        return 'hotel_admin_bundle_registration_form_type';
    }
}
