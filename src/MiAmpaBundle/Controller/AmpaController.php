<?php

namespace MiAmpaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MiAmpaBundle\Entity\Ampa;
use MiAmpaBundle\Form\AmpaType;

/**
 * Ampa controller.
 *
 */
class AmpaController extends Controller
{
    /**
     * Lists all Ampa entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MiAmpaBundle:Ampa')->findAll();

        return $this->render('MiAmpaBundle:Ampa:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Ampa entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Ampa();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ampa_show', array('id' => $entity->getId())));
        }

        return $this->render('MiAmpaBundle:Ampa:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Ampa entity.
     *
     * @param Ampa $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Ampa $entity)
    {
        $form = $this->createForm(new AmpaType(), $entity, array(
            'action' => $this->generateUrl('ampa_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Ampa entity.
     *
     */
    public function newAction()
    {
        $entity = new Ampa();
        $form   = $this->createCreateForm($entity);

        return $this->render('MiAmpaBundle:Ampa:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Ampa entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MiAmpaBundle:Ampa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ampa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MiAmpaBundle:Ampa:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function showBySlugAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $ampa = $em->getRepository('MiAmpaBundle:Ampa')->findAmpaBySlug($slug);

        if(is_null($ampa))
            throw $this->createNotFoundException('Ampa not found');
        
        return $this->render('MiAmpaBundle:Ampa:show.html.twig', array(
            'entity' => $ampa,
        ));
    }

        /**
     * Finds and displays a Ampa entity.
     *
     */
    public function showActionBySlug($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MiAmpaBundle:Ampa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ampa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MiAmpaBundle:Ampa:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Ampa entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MiAmpaBundle:Ampa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ampa entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MiAmpaBundle:Ampa:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Ampa entity.
    *
    * @param Ampa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Ampa $entity)
    {
        $form = $this->createForm(new AmpaType(), $entity, array(
            'action' => $this->generateUrl('ampa_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Ampa entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MiAmpaBundle:Ampa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ampa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ampa_edit', array('id' => $id)));
        }

        return $this->render('MiAmpaBundle:Ampa:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Ampa entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MiAmpaBundle:Ampa')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ampa entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ampa'));
    }

    /**
     * Creates a form to delete a Ampa entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ampa_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
