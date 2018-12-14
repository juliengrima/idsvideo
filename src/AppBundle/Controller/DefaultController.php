<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(){

        return $this->redirectToRoute('fos_user_security_login');

    }

    /**
     * @Route("/home", name="videopage")
     */
    public function videoAction(Request $request)
    {

        $em = $this->getDoctrine ()->getManager ();
        $video = $em->getRepository ('AppBundle:Video')->findAll ();

        // replace this example code with whatever you need
        return $this->render('default/indexWorking.html.twig', array(
            'video' => $video,
        ));

    }

}



































