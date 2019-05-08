<?php


namespace AppBundle\Controller;

use AppBundle\Db\ApiSchema;
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
     * @Rest\Get("/")
     */
    public function getEvent(Request $request)
    {

        $id = intval($request->get("id"));

        if (!$id) {
            throw new HttpException(400,"param [id] must be not null and > 0");
        }

        $event = $this->get('pomm')
            ->getDefaultSession()
            ->getModel(ApiSchema\EventModel::class)
            ->find($id);

        return $this->handleView($this->view(json_encode($event)), Response::HTTP_CREATED);
    }

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

        $event = new ApiSchema\Event([
            'title' => $request->get("title"),
            'start' => new \DateTime($request->get("start")),
            'end' => new \DateTime($request->get("end")),
            'limit' => intval($request->get("limit"))

        ]);

        try {
            $this->get('pomm')
                ->getDefaultSession()
                ->getModel(ApiSchema\EventModel::class)
                ->insertOne($event);

            $response = $this->success("insert");
            return $this->handleView($this->view($response), Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            throw new HttpException(500, "Undefined error");
        }
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Exception
     * @Rest\Put("/")
     */
    public function editEvent(Request $request)
    {
        $id = intval($request->get("id"));

        if (!$id) {
            throw new HttpException(400,"param[id] must be not null and > 0");
        }

        $this->validateDate($request->get("start"));
        $this->validateDate($request->get("end"));

        $eventModel = $this->get('pomm')
                    ->getDefaultSession()
                    ->getModel(ApiSchema\EventModel::class);

        try {

            $event = $eventModel->findByPK(['event_id' => $id]);

            $event
                ->setTitle($request->get("title"))
                ->setEventStart(new \DateTime($request->get("start")))
                ->setEventEnd(new \DateTime($request->get("end")))
                ->setLimit(intval($request->get("limit")));

            $eventModel->updateOne($event, ['title', 'event_start', 'event_end', 'entry_limit']);

            $response = $this->success("update");
            return $this->handleView($this->view($response), Response::HTTP_ACCEPTED);
        } catch (\Exception $exception) {
            throw new HttpException(500, "Undefined error");
        }
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

    public function success($type) {
        switch ($type) {
            case "insert": $response = '{ status: 201, message:"event created"}';break;
            case "update": $response = '{ status: 202, message:"event updated"}';break;
            default: $response = '{ status: 200, message:"success"}';break;
        }

        return $response;
    }

}