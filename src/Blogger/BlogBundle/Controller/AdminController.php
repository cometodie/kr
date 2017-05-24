<?php

namespace Blogger\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller{

    public function indexAction($username = false){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('BloggerBlogBundle:User')->findAll();
        $events = $em->getRepository('BloggerBlogBundle:Event')->findAll();
        $tickets = $em->getRepository('BloggerBlogBundle:Ticket')->findAll();

        return $this->render("BloggerBlogBundle:User/Admin:index.html.twig", array(
            'users' => $users,
            'events' => $events,
            'tickets' => $tickets,
        ));
    }
}