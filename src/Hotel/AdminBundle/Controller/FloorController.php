<?php

namespace Hotel\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hotel\AdminBundle\Entity\Floor;
use Hotel\AdminBundle\Form\FloorType;

/**
 * Floor controller.
 *
 * @Route("/floor")
 */
class FloorController extends Controller
{

    /**
     * Lists all Floor entities.
     *
     * @Route("/", name="floor")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HotelAdminBundle:Floor')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Floor entity.
     *
     * @Route("/", name="floor_create")
     * @Method("POST")
     * @Template("HotelAdminBundle:Floor:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Floor();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('floor_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Floor entity.
     *
     * @param Floor $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Floor $entity)
    {
        $form = $this->createForm(new FloorType(), $entity, array(
            'action' => $this->generateUrl('floor_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Floor entity.
     *
     * @Route("/new", name="floor_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Floor();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Floor entity.
     *
     * @Route("/{id}", name="floor_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HotelAdminBundle:Floor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Floor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Floor entity.
     *
     * @Route("/{id}/edit", name="floor_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HotelAdminBundle:Floor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Floor entity.');
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
    * Creates a form to edit a Floor entity.
    *
    * @param Floor $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Floor $entity)
    {
        $form = $this->createForm(new FloorType(), $entity, array(
            'action' => $this->generateUrl('floor_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Floor entity.
     *
     * @Route("/{id}", name="floor_update")
     * @Method("PUT")
     * @Template("HotelAdminBundle:Floor:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HotelAdminBundle:Floor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Floor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('floor_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Floor entity.
     *
     * @Route("/{id}", name="floor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HotelAdminBundle:Floor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Floor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('floor'));
    }

    /**
     * Creates a form to delete a Floor entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('floor_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
