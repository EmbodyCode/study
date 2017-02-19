<?php

namespace StudyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use StudyBundle\Entity\News;

class DefaultController extends Controller {

    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request) {
        $user = $this->getUser();
        $news = $em = $this->getDoctrine()->getRepository('StudyBundle:News')->findAll();
        if ($request->getMethod() == "POST") {
            $status = $request->get('status');
            $user->setStatus($status);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
        return $this->render('StudyBundle:Default:index.html.twig', array(''
                    . 'user' => $user,''
            . 'newsArray' => $news));
    }

}
