<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\ContactType;
use AppBundle\Entity\Contact;

/**
 * Contact controller.
 *
 */
class ContactController extends Controller
{

    /**
     * Creates a new Contact entity.
     *
     */
    public function newAction(Request $request){
    	
        $contact1 = new Contact();
        $form = $this->createForm('AppBundle\Form\ContactType', $contact1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($contact1 as $value) {

                $contact = $value;

                //   envoi email et message au client
                $message = \Swift_Message::newInstance ()
                    ->setSubject ('Cybix-Technology demande de devis')
                    ->setFrom ('cybix.technology@gmail.com')
                    ->setTo ($contact['mail'])
                    ->setBody (
                        $this->renderView (
                            'app/Resources/views/Emails/formulaire.html.twig', array ('contact' => $contact)
                        ), 'text/html'
                    );
                }


            $this->get('mailer')->send($message);

            foreach ($contact1 as $value) {

                $contact = $value;

                // ----------------------------
                // envoi email à corinne
                $message_corinne = \Swift_Message::newInstance ()
                    ->setSubject ('Demande de devis de' . $contact['nom'])
                    ->setFrom ('cybix.technology@gmail.com')
                    ->setTo ('cybix.technology@gmail.com')
                    ->setBody (
                        $this->renderView (
                            'app/Resources/views/Emails/formulaire.html.twig', array ('contact' => $contact)
                        ), 'text/html'
                    );
            }
            $this->get('mailer')->send($message_corinne);

            return $this->redirectToRoute('homepage');



        }

        return $this->render('Emails/contact.html.twig', array(
            'contact' => $contact1,
            'form' => $form->createView(),
        ));
    }

}
