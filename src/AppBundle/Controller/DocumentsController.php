<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Documents;
use AppBundle\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Document controller.
 *
 */
class DocumentsController extends Controller
{
    /**
     * Lists all document entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $documents = $em->getRepository('AppBundle:Documents')->findAll();

        return $this->render('documents/index.html.twig', array(
            'documents' => $documents,
        ));
    }

    /**
     * Creates a new document entity.
     *
     */
    public function newAction(Request $request)
    {
        $document = new Documents();
        $form = $this->createForm('AppBundle\Form\DocumentsType', $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* KEEP PICTURE */
            $imageForm = $form->get ('media');
            $image = $imageForm->getData ();
            $document->setMedia ($image);

            if (isset($image)) {

                /* GIVE NAME TO THE FILE : PREG_REPLACE PERMITS THE REMOVAL OF SPACES AND OTHER UNDESIRABLE CHARACTERS*/
                $image->setName (preg_replace ('/\W/', '_', "documents_" . uniqid ()));

                // On appelle le service d'upload de média (AppBundle/Services/mediaInterface)
                $this->get ('documents.interface')->mediaUpload ($image);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute('documents_index', array('id' => $document->getId()));
        }

        return $this->render('documents/new.html.twig', array(
            'document' => $document,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a document entity.
     *
     */
    public function showAction(Documents $document)
    {
        $deleteForm = $this->createDeleteForm($document);

        return $this->render('documents/show.html.twig', array(
            'document' => $document,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing document entity.
     *
     */
    public function editAction(Request $request, Documents $document)
    {
        $deleteForm = $this->createDeleteForm($document);
        $editForm = $this->createForm('AppBundle\Form\DocumentsType', $document);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            /* ON RECUP LE FICHIER IMAGE */
            $imageForm = $editForm->get ('media');
            $image = $imageForm->getData ();
            $document->setMedia ($image);

            if (isset($image)) {

                /* ON DEFINI UN NOM UNIQUE AU FICHIER UPLOAD : LE PREG_REPLACE PERMET LA SUPPRESSION DES ESPACES ET AUTRES CARACTERES INDESIRABLES*/
                $image->setName (preg_replace ('/\W/', '_', "documents_" . uniqid ()));

                // On appelle le service d'upload de média (AppBundle/Services/mediaInterface)
                $this->get ('documents.interface')->mediaUpload ($image);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('documents_index', array('id' => $document->getId()));
        }

        return $this->render('documents/edit.html.twig', array(
            'document' => $document,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a document entity.
     *
     */
    public function deleteAction(Request $request, Documents $document)
    {
        $form = $this->createDeleteForm($document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($document);
            $em->flush();
        }

        return $this->redirectToRoute('documents_index');
    }

    /**
     * Creates a form to delete a document entity.
     *
     * @param Documents $document The document entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Documents $document)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('documents_delete', array('id' => $document->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
