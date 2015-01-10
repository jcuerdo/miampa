<?php

namespace MiAmpaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MiAmpaBundle\Entity\ItemMessage;
use MiAmpaBundle\Form\ItemMessageType;

/**
 * ItemMessage controller.
 *
 */
class ItemMessageController extends Controller
{
    /**
     * Creates a new ItemMessage entity.
     *
     */
    public function createAction($slug, $item_id, Request $request)
    {
        $entity = new ItemMessage();

        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository('MiAmpaBundle:Item')->find($item_id);
        $entity->setItem($item);

        $form = $this->createCreateForm($entity, $slug, $item_id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('item_show', array('slug' => $slug, 'item_id' => $item_id)));
        }

        return $this->render('MiAmpaBundle:ItemMessage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ItemMessage entity.
     *
     * @param ItemMessage $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ItemMessage $entity, $slug, $item_id)
    {
        $form = $this->createForm(new ItemMessageType(), $entity, array(
            'action' => $this->generateUrl('item_message_create', array('slug' => $slug,'item_id' => $item_id,)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ItemMessage entity.
     *
     */
    public function newAction($slug, $item_id)
    {
        $entity = new ItemMessage();
        
        $form   = $this->createCreateForm($entity, $slug, $item_id);

        return $this->render('MiAmpaBundle:ItemMessage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ItemMessage entity.
     *
     */
    public function showAction($message_id, $slug, $item_id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MiAmpaBundle:ItemMessage')->find($message_id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemMessage entity.');
        }

        $deleteForm = $this->createDeleteForm($message_id, $slug, $item_id);

        return $this->render('MiAmpaBundle:ItemMessage:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ItemMessage entity.
     *
     */
    public function editAction($id, $slug, $item_id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MiAmpaBundle:ItemMessage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemMessage entity.');
        }

        $editForm = $this->createEditForm($entity, $slug, $item_id);
        $deleteForm = $this->createDeleteForm($id, $slug, $item_id);

        return $this->render('MiAmpaBundle:ItemMessage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ItemMessage entity.
    *
    * @param ItemMessage $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ItemMessage $entity, $slug, $item_id)
    {
        $form = $this->createForm(new ItemMessageType(), $entity, array(
            'action' => $this->generateUrl('item_message_update', array('id' => $entity->getId(),'slug' => $slug, 'item_id' => $item_id)),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ItemMessage entity.
     *
     */
    public function updateAction(Request $request, $id, $slug, $item_id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MiAmpaBundle:ItemMessage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemMessage entity.');
        }

        $deleteForm = $this->createDeleteForm($id, $slug, $item_id);
        $editForm = $this->createEditForm($entity, $slug, $item_id);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

      }

        return $this->render('MiAmpaBundle:ItemMessage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ItemMessage entity.
     *
     */
    public function deleteAction(Request $request, $id, $slug, $item_id)
    {
        $form = $this->createDeleteForm($id, $slug, $item_id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MiAmpaBundle:ItemMessage')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ItemMessage entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('item', array('id' => $item_id)));
    }

    /**
     * Creates a form to delete a ItemMessage entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id, $slug, $item_id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('item_message_delete', array('id' => $id,'slug' => $slug, 'item_id' => $item_id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
