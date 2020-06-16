<?php

namespace NotificationBundle\Controller;

use NotificationBundle\Entity\notification;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    public function addnotifAction(Request $request)
    {
        //get content of data sent by ARC(or postman) tools
        $data = $request->getContent();
        //deserialize the data
        $notification = $this->get('jms_serializer')
            ->deserialize($data,'NotificationBundle\Entity\notification','json');
        // // Get the Doctrine service and manager
        $em = $this->getDoctrine()->getManager();
        // Add our Article to Doctrine so that it can be saved
        $em->persist($notification);
        // Save our Article
        $em->flush();

        return new Response('notification added successfully', 201);
//you can use line number 39 or  line number 41
//         return new Response('product added successfully', Response::HTTP_CREATED);
    }
    public function getnotificationbyidAction(notification $notification)
    {
        $data = $this->get('jms_serializer')->serialize($notification, 'json');
        $response = new Response($data);

        return $response;
    }

    public function getAllnotificationAction()
    {
        $Notification = $this->getDoctrine()
            ->getRepository('NotificationBundle:notification')
            ->findAll();
        $data = $this->get('jms_serializer')->serialize($Notification, 'json');

        $response = new Response($data);

        return $response;
    }

    public function updatenotifAction(Request $request, $id)
    {

        $doctrine = $this->getDoctrine();
        $manager = $doctrine->getManager();
        $product = $doctrine
            ->getRepository('NotificationBundle:notification')
            ->find($id);
        $data = $request->getContent();
        $article = $this->get('jms_serializer')
            ->deserialize($data, 'NotificationBundle\Entity\notification', 'json');

        $product->setTitle($article->getTitle());
        $product->setContent($article->getContent());
        $manager->persist($product);
        $manager->flush();

        return new JsonResponse(['msg' => 'succes!'], 200);
    }

    public function deletenotifAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('NotificationBundle:notification')
            ->find($id);
        $em->remove($article);
        $em->flush();

        return new JsonResponse(['msg' => 'deleted with succes!'], 200);
    }
}
