<?php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        return $this->render('BloggerBlogBundle:Page:index.html.twig');
    }

}