<?php

namespace Hotel\FileManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('HotelFileManagerBundle:Default:index.html.twig', array('name' => $name));
    }
}
