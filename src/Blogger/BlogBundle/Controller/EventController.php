<?php

namespace Blogger\BlogBundle\Controller;

use Blogger\BlogBundle\Entity\Event;
use Blogger\BlogBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Blogger\BlogBundle\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Event controller.
 *
 * @Route("event")
 */
class EventController extends Controller
{
    /**
     * Lists all event entities.
     *
     * @Route("/", name="event_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('BloggerBlogBundle:Event')->findAll();
        $news = $em->getRepository('BloggerBlogBundle:News')->findAll();

        for($i = 0; $i < sizeof($news); $i++){
            // var_dump($news[$i]->getDate());
            $date = $news[$i]->getDate()->format('j F');

            // echo($date);
        }

        return $this->render('event/index.html.twig', array(
            'events' => $events,
            'news' => $news,
        ));
    }


    /**
     * Lists all event entities.
     *
     * @Route("/", name="event_admin_index")
     * @Method("GET")
     */
    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('BloggerBlogBundle:Event')->findAll();

        return $this->render('event/admin_index.html.twig', array(
            'events' => $events,
        ));
    }

    /**
     * Creates a new event entity.
     *
     * @Route("/new", name="event_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $event = new Event();
        $form = $this->createForm('Blogger\BlogBundle\Form\EventType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('event_show', array('id' => $event->getId()));
        }

        return $this->render('event/new.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     * @Route("/{id}", name="event_show")
     * @Method("GET")
     */
    public function showAction(Event $event)
    {
        $deleteForm = $this->createDeleteForm($event);

        return $this->render('event/show.html.twig', array(
            'event' => $event,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     * @Route("/{id}/edit", name="event_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Event $event)
    {
        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('Blogger\BlogBundle\Form\EventType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_edit', array('id' => $event->getId()));
        }

        return $this->render('event/edit.html.twig', array(
            'event' => $event,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a event entity.
     *
     * @param Event $event The event entity
     *
     * @Route("/{id}/buy", name="ticket_buy")
     * @Method({"GET", "POST"})
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function buyAction(){

        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('BloggerBlogBundle:Event')->find($_POST['event_id']);

        $ticket = new Ticket();
        $ticket->setEvent($_POST['event_id']);
        $ticket->setUser($this->getUser()->getId());
        $ticket->setNumber(intval($_POST['_count']));
        $ticket->setCost(20);
        $ticket->setSold(true);

        $em->persist($ticket);

        $em->flush();

        return $this->render('ticket/ok.html.twig',array(
            'event' => $event,
        ));
    }

    /**
     * Deletes a event entity.
     *
     * @Route("/{id}", name="event_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Event $event)
    {
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
        }

        return $this->redirectToRoute('event_index');
    }

    /**
     * Creates a form to delete a event entity.
     *
     * @param Event $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Event $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('event_delete', array('id' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


}
