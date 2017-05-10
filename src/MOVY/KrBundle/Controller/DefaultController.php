<?php

namespace MOVY\KrBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="movy_events_homepage")
     */
    public function indexAction()
    {
        return $this->render('bid/new.html.twig');
    }

}
