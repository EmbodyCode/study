<?php

namespace StudyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use StudyBundle\Entity\News;
use StudyBundle\Entity\Events;
use StudyBundle\Form\NewsType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use StudyBundle\Form\StatusType;
use StudyBundle\Form\EventType;

class DefaultController extends Controller {

    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request) {
        $user = $this->getUser();
        $findNews = $em = $this->getDoctrine()->getRepository('StudyBundle:News')->findBy(array(), array('id' => 'DESC'));
        $news = new News();
        $events = new Events();
        $formNews = $this->createForm(NewsType::class, $news);
        $formStatus = $this->createForm(StatusType::class, $user);
        $formEvents = $this->createForm(EventType::class, $events);

        /* Обновление статуса пользователя */
        if ($request->getMethod() == "POST") {
            $formNews->handleRequest($request);
            $formStatus->handleRequest($request);
            $formEvents->handleRequest($request);

            if ($formNews->get('Добавить')->isClicked() and $formNews->isValid()) {
                $news = $formNews->getData();
                $news->setCreatedAt(new \DateTime('now'));
                $news->setUpdatedAt(new \DateTime('now'));
                $news->setAuthor($user->getUsername());
                $news->setClassDestination($user->getClass());
                $em = $this->getDoctrine()->getManager();
                $em->persist($news);
                $em->flush();
                return $this->redirectToRoute('home');
            } 
            if ($formStatus->get('Добавить')->isClicked() and $formStatus->isValid())
            {
                
                $status = $formStatus->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($status);
                $em->flush();
                return $this->redirectToRoute('home');
            }
            if ($formEvents->get('Сохранить')->isClicked())
            {
                $events = $formEvents->getData();
                $events->setCreatedAt(new \DateTime('now'));
                $events->setUpdatedAt(new \DateTime('now'));
                $em = $this->getDoctrine()->getManager();
                $em->persist($status);
                $em->flush();
                return $this->redirectToRoute('home');
            }
        }

        return $this->render('StudyBundle:Default:index.html.twig', array(''
                    . 'user' => $user, ''
                    . 'newsArray' => $findNews, ''
                    . 'form' => $formNews->createView(),''
            . 'form2' => $formStatus->createView(),''
            . 'form3' => $formEvents->createView()));
    }

}
