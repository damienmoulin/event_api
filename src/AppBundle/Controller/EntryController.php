<?php


namespace AppBundle\Controller;

use AppBundle\Db\ApiSchema;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EntryController
 * @package AppBundle\Controller
 * @Route("/entry", name="entry_")
 */
class EntryController extends FOSRestController
{
    /**
     * @param Request $request
     * @return Response
     * @throws \Exception
     * @Rest\Post("/")
     */
    public function postEntry(Request $request)
    {
        $eventId = $request->get("event_id");

        if (!$eventId) {
            throw new HttpException(400,"param[event_id] must be not null and > 0");
        }

        if (!$request->get("firstname") || !$request->get("lastname") || !$request->get("email") || !$request->get("phone")) {
            throw new HttpException(400,"params[firstname], params[lastname], params[email], params[phone] are required");
        }


        $event = $this->get('pomm')
            ->getDefaultSession()
            ->getModel(ApiSchema\EventModel::class)
            ->find($eventId);

        if ($event->current()) {

            $event = $event->current();

            if ($event->getEventEnd() <= new \DateTime()) {
                $response = $this->error("completed");
                return $this->handleView($this->view($response), Response::HTTP_NOT_FOUND);
            }

            foreach ($event->getEntry() as $entry) {
                if ($entry->getEmail() == $request->get("email")) {
                    $response = $this->error("already_entry");
                    return $this->handleView($this->view($response), Response::HTTP_NOT_FOUND);
                }
            }

            if (count($event->getEntry()) < $event->getEntryLimit() || ($event->getEntry() == [null]) && $event->getEntryLimit() > 0) {

                $entry = new ApiSchema\Entry([
                    'firstname' => $request->get("firstname"),
                    'lastname' => $request->get("lastname"),
                    'phone' => $request->get("phone"),
                    'email' => $request->get("email"),
                    'event_id' => $eventId
                ]);

                try {
                    $this->get('pomm')
                        ->getDefaultSession()
                        ->getModel(ApiSchema\EntryModel::class)
                        ->insertOne($entry);

                    $response = $this->success("insert");
                    return $this->handleView($this->view($response), Response::HTTP_CREATED);
                } catch (\Exception $exception) {
                    throw new HttpException(500, "Undefined error");
                }
            } else {
                $response = $this->error("limit");
                return $this->handleView($this->view($response), Response::HTTP_NOT_FOUND);
            }

        }
        return new Response();
    }

    public function success($type) {
        switch ($type) {
            case "insert": $response = '{ status: 201, message:"event created"}';break;
            default: $response = '{ status: 200, message:"success"}';break;
        }

        return $response;
    }

    public function error($type) {
        switch($type) {
            case "already_entry": $response = '{ status: 400, message: "email already subscriber at the event"}';break;
            case "completed": $response = '{ status: 400, message: "event is completed"}';break;
            case "limit": $response = '{ status: 400, message: "the subscriber limit has been reached"}';break;
            default: $response = '{ status: 400, message:"entry unavailable"}';break;
        }

        return $response;
    }

}