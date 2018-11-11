<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\EventHasForm;
//use Overall\Bundle\SSRI\AdminBundle\Form\ActividadType;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class EventHasFormController extends Controller {

    //http://www.prowebdev.us/2012/07/symfnoy2-many-to-many-relation-with.html


    public function removeFormAction(Request $request)
    {
        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_USER')) {
            $response->status = "access-denied";
            $responseJson = json_encode($response);
            return new \Symfony\Component\HttpFoundation\Response($responseJson);
        }

        try {
            $eventUniqueId = $request->get('eventUniqueId');
            $idForm = $request->get('idForm');
            $em = $this->getDoctrine()->getManager();
            $eventHasForm = $em->getRepository('MainBundle:EventHasForm')->findOneByEventAndForm($eventUniqueId, $idForm);

            if ($eventHasForm) {
                $em->remove($eventHasForm);
                $em->flush();
            }

            $response->status = "ok";
        }catch (Exception $e){
            $response->status = "fail";
        }

        return new \Symfony\Component\HttpFoundation\Response(json_encode($response));

    }

}
