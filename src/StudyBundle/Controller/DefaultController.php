<?php

namespace StudyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use StudyBundle\Entity\News;
use StudyBundle\Form\NewsType;

class DefaultController extends Controller {

    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request) {
        $user = $this->getUser();
        $findNews = $em = $this->getDoctrine()->getRepository('StudyBundle:News')->findBy(array(), array('id' => 'DESC'));
        
        /** Добавление новости **/
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $news = $form->getData();
            $news->setCreatedAt(new \DateTime('now'));
            $news->setUpdatedAt(new \DateTime('now'));
            $news->setAuthor($user->getUsername());
            $news->setClassDestination($user->getClass());
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();
        }
        
        /* Обновление статуса пользователя */
        if ($request->getMethod() == "POST") {
            $status = $request->get('status');
            $user->setStatus($status);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('home');
        }      
        
        return $this->render('StudyBundle:Default:index.html.twig', array(''
                    . 'user' => $user,''
            . 'newsArray' => $findNews,''
            . 'form' => $form->createView()));
    }
    
    /**
     * @Route(name="addNews")
     */
    public function addNewsAction(Request $request)
    {
        $user = $this->getUser();
        if ($request->getMethod()=="POST")
        {
            $news = new News();
            $form = $this->createForm(NewsType::class, $news);
            $title = $request->get('title');
            $shortText = $request->get('shortText');
            $fullText = $request->get('fullNewsText');
            $type = $request->get('type');
            $news->setTitle($title);
            $news->setShortText($shortText);
            $news->setAuthor($user->getUsername());
            $news->setFullNewsText($fullText);
            $news->setType($type);
            $news->setClassDestination($user->getClass());
            $news->setCreatedAt(new \DateTime('now'));
            $news->setUpdatedAt(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();
            return $this->redirect('http://google.com');
        }
        return $this->redirect('http://google.com');
        
    }

}
