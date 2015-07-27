<?php

namespace Hotel\FrontBundle\Controller;

use Hotel\AdminBundle\Entity\Reservation;
use Hotel\AdminBundle\Form\ReservationType;
use Hotel\FrontBundle\Form\MakeReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @Route("/make-reservation", name="make_reservation")
     * @Template()
     */
    public function makeReservationAction(Request $request)
    {


        $form = $this->createForm(new MakeReservationType());

        return array(
            'form' => $form->createView()
        );
    }
}
