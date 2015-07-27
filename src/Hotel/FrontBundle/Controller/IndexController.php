<?php

namespace Hotel\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController extends Controller
{
    /**
     * @Route("/", name="home_page")
     * @Template()
     */
    public function mainPageAction()
    {
        $RoomRepo = $this->getDoctrine()->getRepository('HotelAdminBundle:Room');
        $allRooms = $RoomRepo->findAll();

        return array(
            'rooms' => $allRooms
        );
    }
}
