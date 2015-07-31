<?php

namespace Hotel\AdminBundle;

use Hotel\AdminBundle\DependencyInjection\Compiler\jj;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class HotelAdminBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

    }
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
