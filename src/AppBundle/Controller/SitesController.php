<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sites;
use AppBundle\Form\SitesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Site controller.
 *
 */
class SitesController extends Controller
{
    /**
     * Lists all site entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sites = $em->getRepository('AppBundle:Sites')->findAll();

        return $this->render('sites/index.html.twig', array(
            'sites' => $sites,
        ));
    }

    /**
     * Creates a new site entity.
     *
     */
    public function newAction(Request $request)
    {
        $site = new Sites();
        $form = $this->createForm('AppBundle\Form\SitesType', $site);
        $form->setData ($site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* ON RECUP LE FICHIER IMAGE */
            $imageForm = $form->get ('media');
            $image = $imageForm->getData ();
            $site->setMedia ($image);

            if (isset($image)) {

                /* ON DEFINI UN NOM UNIQUE AU FICHIER UPLOAD : LE PREG_REPLACE PERMET LA SUPPRESSION DES ESPACES ET AUTRES CARACTERES INDESIRABLES*/
                $image->setName (preg_replace ('/\W/', '_', "Object_" . uniqid ()));

                // On appelle le service d'upload de média (AppBundle/Services/mediaInterface)
                $this->get ('media.interface')->mediaUpload ($image);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($site);
            $em->flush();

            return $this->redirectToRoute('sites_show', array('id' => $site->getId()));
        }

        return $this->render('sites/new.html.twig', array(
            'site' => $site,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a site entity.
     *
     */
    public function showAction(Sites $site)
    {
        $deleteForm = $this->createDeleteForm($site);

        return $this->render('sites/show.html.twig', array(
            'site' => $site,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing site entity.
     *
     */
    public function editAction(Request $request, Sites $site)
    {
        $deleteForm = $this->createDeleteForm($site);
        $editForm = $this->createForm('AppBundle\Form\SitesType', $site);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sites_edit', array('id' => $site->getId()));
        }

        return $this->render('sites/edit.html.twig', array(
            'site' => $site,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a site entity.
     *
     */
    public function deleteAction(Request $request, Sites $site)
    {
        $form = $this->createDeleteForm($site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($site);
            $em->flush();
        }

        return $this->redirectToRoute('sites_index');
    }

    /**
     * Creates a form to delete a site entity.
     *
     * @param Sites $site The site entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sites $site)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sites_delete', array('id' => $site->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
