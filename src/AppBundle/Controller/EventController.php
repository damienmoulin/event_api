<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Entry;
use AppBundle\Entity\Event;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EventController
 * @package AppBundle\Controller
 * @Route("/event", name="event_")
 */
class EventController extends FOSRestController
{

    /**
     * @param Request $request
     * @return Response
     * @throws \Exception
     * @Rest\Post("/")
     */
    public function postEvent(Request $request)
    {
        $this->validateDate($request->get("start"));
        $this->validateDate($request->get("end"));

        $event = new Event();

        $event->setTitle($request->get("title"));
        $event->setStart(new \DateTime($request->get("start")));
        $event->setEnd(new \DateTime($request->get("end")));
        $event->setLimit($request->get("limit"));

        var_dump($event);

        return new Response();
    }

    /**
     * @param $date
     */
    public function validateDate($date)
    {
        if(!\DateTime::createFromFormat('Y-m-d H:i:s', $date)) {
            throw new HttpException(400,"Unvalid Datetime");
        }
    }
}