<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\Gcm;
//use Overall\Bundle\SSRI\AdminBundle\Form\ActividadType;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;


class GcmController extends Controller {

    public function indexAction()
    {

        return $this->render(
            'BackendBundle:Gcm:index.html.twig',
            array(
                'form' => '',
            )
        );

    }

    public function listAction()
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_LIST_GCM')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $em = $this->getDoctrine()->getManager();
        $gcm = $em->getRepository('MainBundle:Gcm')->findAll();

        $serializer = $this->container->get('jms_serializer');
        $gcmJson = $serializer->serialize(
            $gcm,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('gcm_data'))
        );

        return $this->render(
            'BackendBundle:Gcm:list.html.twig',
            array(
                'gcmJson' => $gcmJson,
            )
        );

    }

    public function createAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_GCM')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $gcm = new Gcm();
        $form = $this->createForm('MainBundle\Form\GcmType', $gcm,  array('attr' => array('class' => 'form-horizontal')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($gcm);
            $em->flush();

            $result = $this->sendAction($gcm);

            $this->get('session')->getFlashBag()->add('notice', json_encode($result));

            return $this->redirectToRoute('backend_gcm_list');
        }

        return $this->render(
            'BackendBundle:Gcm:form.html.twig',
            array(
                'gcmForm' => $form->createView(),
                'action' => 'crear',
            )
        );
    }

    public function deleteAction(Request $request)
    {

        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_DELETE_GCM')) {
            $response->status = "access-denied";
            $responseJson = json_encode($response);
            return new \Symfony\Component\HttpFoundation\Response($responseJson);
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $gcm = $em->getRepository('MainBundle:Gcm')->findOneByIdIncrement($id);

        $response = new \stdClass();

        try {
            $gcm->setStatus(0);
            $em->persist($gcm);
            $em->flush();

            $response->status = "ok";
        }catch (\Exception $e){
            $response->status = "fail";
        }

        $response_json = json_encode($response);

        return new \Symfony\Component\HttpFoundation\Response($response_json);

    }


    public function sendAction($gcm)
    {

        //conseguir los devis code del user
//        $user = $gcm->getUser()->getDeviceCode();
//
//        $arrayDeviceCode = [];
//        foreach($user as $key => $value){
//            $arrayDeviceCode[] = $value->getDeviceCode();
//        }
//        $gcm->setDeviceCodes($arrayDeviceCode);
        //conseguir los deviceCodes code del user

        $debug = $this->get('main.util.gcm_service');
        $result = $debug->send($gcm);

        return $result;

    }





}
