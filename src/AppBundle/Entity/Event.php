<?php


namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Event
{
    /**
     * @var $id
     */
    private $id;

    /**
     * @var $title
     */
    private $title;

    /**
     * @var $start \DateTime
     * @var string A "Y-m-d" formatted value
     */
    private $start;

    /**
     * @var $end \DateTime
     * @var string A "Y-m-d" formatted value
     */
    private $end;

    /**
     * @var $limit
     */
    private $limit;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return Assert\DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param \DateTime $start
     */
    public function setStart(\DateTime $start): void
    {
        $this->start = $start;
    }

    /**
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param \DateTime $end
     */
    public function setEnd(\DateTime $end): void
    {
        $this->end = $end;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param mixed $limit
     */
    public function setLimit($limit): void
    {
        $this->limit = intval($limit);
    }



}