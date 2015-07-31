<?php

namespace Hotel\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SliderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('news', 'entity', array('class' => 'Hotel\AdminBundle\Entity\News','label' => 'News: ', 'property' => 'title'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Hotel\AdminBundle\Entity\Slider'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hotel_adminbundle_slider';
    }
}
