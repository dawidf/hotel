<?php

namespace Hotel\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hotel\AdminBundle\Entity\Room;
use Hotel\AdminBundle\Form\RoomType;
use Symfony\Component\HttpFoundation\Response;


/**
 * Room controller.
 *
 * @Route("/room")
 */
class RoomController extends Controller
{

    /**
     * Lists all Room entities.
     *
     * @Route("/list/{page}", name="room", defaults={"page"="1"})
     * @Method("GET")
     * @Template()
     */
    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getManager();

        $rooms = $em->getRepository('HotelAdminBundle:Room')->findAll();

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate($rooms, $page, 20);


        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Room entity.
     *
     * @Route("/", name="room_create")
     * @Method("POST")
     * @Template("HotelAdminBundle:Room:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Room();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('room_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Room entity.
     *
     * @param Room $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Room $entity)
    {
        $form = $this->createForm(new RoomType(), $entity, array(
            'action' => $this->generateUrl('room_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Room entity.
     *
     * @Route("/new", name="room_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Room();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }


    /**
     * @Template()
     * @Route("/check_is_avalible_rooms", name="check_is_avalible_rooms")
     */
    public function searchAction(Request $request)
    {


        $params = array();
        $params['startDate'] = $request->query->get('startDate');
        $params['peopleOfRoom'] = $request->query->get('peopleOfRoom');
        $params['endDate'] = $request->query->get('endDate');
//        var_dump($request->query->all());

        $RoomRepo = $this->getDoctrine()->getRepository('HotelAdminBundle:Room');
        $qb = $RoomRepo->getAvalibleRooms($request->query->all());


//        var_dump($qb);

        $countRooms = $RoomRepo->countRooms($params['peopleOfRoom']);

//        $query = $this->getDoctrine()->getEntityManager()->createQueryBuilder();
//        $a = array('001', '000');
//        $query
//            ->select('room.roomNumber')
//            ->from('HotelAdminBundle:Room', 'room')
//            ->leftjoin('room.reservations', 'reservations')
//            ->andWhere($query->expr()->notIn('room.roomNumber', $a))
//            ;
//        $results = $query->getQuery()->getArrayResult();
//
////
//        $asd = $RoomRepo->getNextAvailableDate($request->query->all());
//
//        var_dump($asd);
//
//
//
//
//        $nextAvailableRoom = $RoomRepo->getNextAvailableDate($request->query);
////
//        var_dump($nextAvailableRoom);

        if( ($qb === $countRooms) )
        {
//            if($nextAvailableRoom !== false)
//            {
//
//            }
            return new JsonResponse(
                array(
                    'roomAvalible' => 'false'
                )
            );
        }
        else{
            return new JsonResponse(
                array(
                    'roomAvalible' => 'true'
                )
            );
        }


    }

    /**
     * Finds and displays a Room entity.
     *
     * @Route("/{id}", name="room_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HotelAdminBundle:Room')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Room entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Room entity.
     *
     * @Route("/{id}/edit", name="room_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HotelAdminBundle:Room')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Room entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Room entity.
    *
    * @param Room $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Room $entity)
    {
        $form = $this->createForm(new RoomType(), $entity, array(
            'action' => $this->generateUrl('room_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Room entity.
     *
     * @Route("/{id}", name="room_update")
     * @Method("PUT")
     * @Template("HotelAdminBundle:Room:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HotelAdminBundle:Room')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Room entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('room_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Room entity.
     *
     * @Route("/{id}", name="room_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HotelAdminBundle:Room')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Room entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('room'));
    }

    /**
     * Creates a form to delete a Room entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('room_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }


}
