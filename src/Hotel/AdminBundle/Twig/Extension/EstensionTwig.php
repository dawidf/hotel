<?php

namespace Hotel\AdminBundle\Twig\Extension;

class EstensionTwig extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'estension_twig';
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('cutDesc', array($this, 'cutDescription'), array('is_safe' => array('html')))
        );
    }


    public function cutDescription($text, $length = 200, $wrapTag = 'p') {
        $text = strip_tags($text);
        $text = substr($text, 0, $length).'[...]';
        $openTag = "<{$wrapTag}>";
        $closeTag = "</{$wrapTag}>";

        return $openTag.$text.$closeTag;
    }
}
