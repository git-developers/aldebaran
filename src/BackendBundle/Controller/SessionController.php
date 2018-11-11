<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\Profile;
//use Overall\Bundle\SSRI\AdminBundle\Form\ActividadType;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class SessionController extends Controller {

    public function listAction()
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_LIST_USER_SESSION')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('MainBundle:Session')->findAll();

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $entities,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('session_data'))
        );

        return $this->render(
            'BackendBundle:Session:list.html.twig',
            array(
                'entitiesJson' => $entitiesJson,
            )
        );

    }

    public function deleteAction(Request $request)
    {

        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_DELETE_USER_SESSION')) {
            $response->status = "access-denied";
            $responseJson = json_encode($response);
            return new \Symfony\Component\HttpFoundation\Response($responseJson);
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:Session')->findOneById($id);

        try {
            $em->remove($entity);
            $em->flush();

            $response->status = "ok";
        }catch (\Exception $e){
            $response->status = "fail";
        }

        $response_json = json_encode($response);

        return new \Symfony\Component\HttpFoundation\Response($response_json);

    }

}
