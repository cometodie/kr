<?php

namespace Blogger\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Entity\Repository\RoleRepository")
 */
class Ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @var int
     *
     * @ORM\Column(name="event_id", type="integer")
     */
    private $event;

    /**
     *
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var bool
     *
     * @ORM\Column(name="sold", type="boolean")
     */
    private $sold;

    /**
     * @var int
     *
     * @ORM\Column(name="cost", type="integer")
     */
    private $cost;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set event
     *
     * @param \stdClass $event
     *
     * @return Ticket
     */
    public function setEvent($event)
    {
        
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \stdClass
     */
    public function getEvent()
    {
        
        return $this->event;
    }

    /**
     * Set user
     *
     * @param \stdClass $user
     *
     * @return Ticket
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \stdClass
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Ticket
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set sold
     *
     * @param boolean $sold
     *
     * @return Ticket
     */
    public function setSold($sold)
    {
        $this->sold = $sold;

        return $this;
    }

    /**
     * Get sold
     *
     * @return bool
     */
    public function getSold()
    {
        return $this->sold;
    }

    /**
     * Set cost
     *
     * @param integer $cost
     *
     * @return Ticket
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return int
     */
    public function getCost()
    {
        return $this->cost;
    }
}
