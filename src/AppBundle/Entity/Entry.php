<?php


namespace App\Entity;


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
    private $event_id;

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
    public function setId($id): void
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
    public function setFirstname($firstname): void
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
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return Assert\Email
     */
    public function getEmail(): Assert\Email
    {
        return $this->email;
    }

    /**
     * @param Assert\Email $email
     */
    public function setEmail(Assert\Email $email): void
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
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return Event
     */
    public function getEventId(): Event
    {
        return $this->event_id;
    }

    /**
     * @param Event $event_id
     */
    public function setEventId(Event $event_id): void
    {
        $this->event_id = $event_id;
    }


}