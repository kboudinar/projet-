<?php

namespace NotificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use NotificationBundle\Entity\campany;
use NotificationBundle\Entity\Follow;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FollowingController extends Controller
{
    public function addfollowAction(Request $request)
    {

//get content of data sent by ARC(or postman) tools
        $em = $this->getDoctrine()->getManager();
        $data = $request->getContent();

        // Get the Doctrine service and manager

        $campany = $em
            ->getRepository('NotificationBundle\Entity\campany')
            ->find(json_decode($data)->idcampany);
        $candidate = $em
            ->getRepository('NotificationBundle\Entity\Candidat')
            ->find(json_decode($data)->idcandidat);
        $follow = new Follow();
        $follow->setIdcampany($campany);
        $follow->setIdcandidat($candidate);


        // Add our Article to Doctrine so that it can be saved
        $em->persist($follow);
        // Save our Article
        $em->flush();

        return new Response('follow added successfully', 201);


    }

    public function showfollowAction()
    {
        $follows = $this->getDoctrine()
            ->getRepository('NotificationBundle:Follow')
            ->findAll();
        $data = $this->get('jms_serializer')->serialize($follows, 'json');

        $response = new Response($data);


        return $response;
    }

    public function getfollowByidAction(Follow $follow)
    {
        $data = $this->get('jms_serializer')->serialize($follow, 'json');
        $response = new Response($data);

        return $response;
    }
    public function getAllfollowsAction()
    {
        $follows = $this->getDoctrine()
            ->getRepository('NotificationBundle:Follow')
            //->findAll();
            ->findAllfollow();
        $data = $this->get('jms_serializer')->serialize($follows, 'json');

        $response = new Response($data);

        return $response;
    }

    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $follow = $em->getRepository('NotificationBundle:Follow')
            ->find($id);
        $em->remove($follow);
        $em->flush();

        return new JsonResponse(['msg' => 'Follow deleted with succes!'], 200);
    }



}
