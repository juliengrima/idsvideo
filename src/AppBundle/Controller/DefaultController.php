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
//    public function indexAction(){
//
//        return $this->redirectToRoute('fos_user_security_login');
//
//    }

//    /**
//     * @Route("/home", name="videopage")
//     */

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

//        $em = $this->getDoctrine ()->getManager ();
//        $site = $em->getRepository ('AppBundle:Sites')->findAll ();

//        // replace this example code with whatever you need
//        return $this->render('default/indexWorking.html.twig', array(
//            'sites' => $site,
//        ));

        return $this->render('default/indexWorking.html.twig');
    }

}



































