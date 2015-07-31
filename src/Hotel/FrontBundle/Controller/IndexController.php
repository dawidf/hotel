<?php

namespace Hotel\FrontBundle\Controller;

use Hotel\AdminBundle\Entity\Reservation;
use Hotel\AdminBundle\Entity\Room;
use Hotel\AdminBundle\Form\ReservationType;
use Hotel\FrontBundle\Form\MakeReservationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{

    /**
     * @Route("/make-reservation", name="make_reservation")
     * @Template()
     */
    public function makeReservationAction(Request $request)
    {

        $Resrvation = new Reservation();

        $form = $this->createForm(new MakeReservationType(), $Resrvation);

        if($request->isMethod('POST'))
        {
            $em = $this->getDoctrine()->getManager();
            $RoomRepository = $em->getRepository('HotelAdminBundle:Room');
            $req = $request->request->get('hotel_front_bundle_make_reservation');
            $nextAvalibleRoom = $RoomRepository->getNextAvailableDate($req);

            $roomId = $RoomRepository->findOneById($nextAvalibleRoom);

            $Resrvation->setRoom($roomId);
            $Resrvation->setClient($this->getUser());

            ;
            $form->handleRequest($request);
//

            if($form->isValid())
            {



//                var_dump($form->get('startReservation')->getData());


//                var_dump($nextAvalibleRoom);
                $em->persist($Resrvation);

                $em->flush();

                $Session = $this->get('session');
                $Session->getFlashBag()->add('success', 'Reservation complete successful');

                return $this->redirect($this->generateUrl('make_reservation'));
            }

        }


        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{page}", name="home_page", defaults={"page"="1"})
     * @Template()
     */
    public function mainPageAction($page)
    {

        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('HotelAdminBundle:News')->getNewsWithAuthor();

        $paginator = $this->get('knp_paginator');
        $allNews = $paginator->paginate($news, $page, 5);

        $em = $this->getDoctrine()->getManager();
        $slider = $em->getRepository('HotelAdminBundle:News')->getSliderWithNews();

        return array(
            'news' => $allNews,
            'slider' => $slider
        );
    }

    /**
     * Finds and displays a News entity.
     *
     * @Route("/news/{slug}", name="front_news_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('HotelAdminBundle:News')->findOneBySlug($slug);

        if (!$news) {
            throw $this->createNotFoundException('Unable to find News.');
        }



        return array(
            'new' => $news,

        );
    }


}
