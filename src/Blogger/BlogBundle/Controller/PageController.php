<?php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        return $this->render('BloggerBlogBundle:Page:index.html.twig');
    }

    public function contactAction(){
        return $this->render('BloggerBlogBundle:Page:contact.html.twig');
    }

    public function galleryAction(){
        $em = $this->getDoctrine()->getManager();
        $pictures = $em->getRepository('BloggerBlogBundle:Gallery')->findAll();
        return $this->render('BloggerBlogBundle:Page:gallery.html.twig', array(
            'pictures' => $pictures,
        ));
    }

}