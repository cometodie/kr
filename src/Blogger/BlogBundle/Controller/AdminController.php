<?php

namespace Blogger\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller{
    public function indexAction($username = false){
        return $this->render("BloggerBlogBundle:User/Admin:index.html.twig");
    }
}