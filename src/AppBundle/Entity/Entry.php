<?php


namespace AppBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;

class Entry
{

    /**
     * @var $id
     */
    private $id;

    /**
     * @var $firstname
     */
    private $firstname;

    /**
     * @var $lastname
     */
    private $lastname;

    /**
     * @var $email Assert\Email
     */
    private $email;

    /**
     * @var $phone
     */
    private $phone;

    /**
     * @var $event Event
     */
    private $event;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return Assert\Email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param Assert\Email $email
     */
    public function setEmail(Assert\Email $email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return Event
     */
    public function getEvent()
    {
        return $this->event_id;
    }

    /**
     * @param Event $event
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;
    }


}