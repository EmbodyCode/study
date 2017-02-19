<?php

namespace StudyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use StudyBundle\Entity\News;
use StudyBundle\Form\NewsType;
use StudyBundle\Form\StatusType;

class DefaultController extends Controller {

    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request) {
        $user = $this->getUser();
        $findNews = $em = $this->getDoctrine()->getRepository('StudyBundle:News')->findBy(array(), array('id' => 'DESC'));
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form2 = $this->createForm(StatusType::class, $user);

        /* Обновление статуса пользователя */
        if ($request->getMethod() == "POST") {
            $form->handleRequest($request);
            $form2->handleRequest($request);

            if ($form->isSubmitted()) {
                $news = $form->getData();
                $news->setCreatedAt(new \DateTime('now'));
                $news->setUpdatedAt(new \DateTime('now'));
                $news->setAuthor($user->getUsername());
                $news->setClassDestination($user->getClass());
                $em = $this->getDoctrine()->getManager();
                $em->persist($news);
                $em->flush();
                return $this->redirectToRoute('home');
            } 
            else if($form2->isSubmitted())
            {
                
                $status = $form2->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($status);
                $em->flush();
                return $this->redirectToRoute('home');
            }
        }

        return $this->render('StudyBundle:Default:index.html.twig', array(''
                    . 'user' => $user, ''
                    . 'newsArray' => $findNews, ''
                    . 'form' => $form->createView(),''
            . 'form2' => $form2->createView()));
    }

}
