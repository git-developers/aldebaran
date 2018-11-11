<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\ConfigurationEmail;
//use Overall\Bundle\SSRI\AdminBundle\Form\ActividadType;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class ConfigurationEmailController extends Controller {

    public function indexAction()
    {

        return $this->render(
            'BackendBundle:ConfigurationEmail:index.html.twig',
            array(
                'form' => '',
            )
        );

    }

    public function listAction()
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_LIST_CONFIGURATION_EMAIL')) {
            return $this->redirectToRoute('frontend_default_access_denied');
            //throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('MainBundle:ConfigurationEmail')->findAll();

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $entities,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('configuration_email_data'))
        );

        return $this->render(
            'BackendBundle:ConfigurationEmail:list.html.twig',
            array(
                'entitiesJson' => $entitiesJson,
            )
        );

    }

    public function createAction(Request $request)
    {

        $entity = new ConfigurationEmail();
        $form = $this->createForm('MainBundle\Form\ConfigurationEmailType', $entity,  array('attr' => array('class' => 'form-horizontal')));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $this->get('security.authorization_checker')->isGranted('ROLE_CREATE_CONFIGURATION_EMAIL')) {

            $em = $this->getDoctrine()->getManager();
            $em->getRepository('MainBundle:ConfigurationEmail')->deleteAll();
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('backend_configuration_email_list', array('id' => $entity->getIdIncrement()));
        }

        return $this->render(
            'BackendBundle:ConfigurationEmail:form.html.twig',
            array(
                'formEntity' => $form->createView(),
                'action' => 'crear',
                'id' => null,
            )
        );
    }

    public function createAjaxAction(Request $request)
    {

        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_CONFIGURATION_EMAIL')) {
            $response->status = "access-denied";
            $responseJson = json_encode($response);
            return new \Symfony\Component\HttpFoundation\Response($responseJson);
        }

        $user = $this->getUser();
        $entity = new ConfigurationEmail();
        $form = $this->createForm('MainBundle\Form\ConfigurationEmailType', $entity,  array('attr' => array('class' => 'form-horizontal')));
        $form->handleRequest($request);

        $response->status = "fail";

        try {
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $entity->setUser($user);
                $em->persist($entity);
                $em->flush();
                $response->status = "ok";
            }

        }catch (\Exception $e){
            $response->status = "exception";
        }

        $responseJson = json_encode($response);

        return new \Symfony\Component\HttpFoundation\Response($responseJson);
    }

    public function editAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_CONFIGURATION_EMAIL')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:ConfigurationEmail')->find($id);
        $form = $this->createForm('MainBundle\Form\ConfigurationEmailType', $entity,  array('attr' => array('class' => 'form-horizontal')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('backend_configuration_email_list');
        }

        return $this->render(
            'BackendBundle:ConfigurationEmail:form.html.twig',
            array(
                'formEntity' => $form->createView(),
                'action' => 'editar',
                'id' => $id,
            )
        );
    }

    public function deleteAction(Request $request)
    {
        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_DELETE_CONFIGURATION_EMAIL')) {
            $response->status = "access-denied";
            $responseJson = json_encode($response);
            return new \Symfony\Component\HttpFoundation\Response($responseJson);
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:ConfigurationEmail')->findOneByIdIncrement($id);

        $response = new \stdClass();

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

    private function notFoundException($entity, $message)
    {
        if(!$entity)
            throw $this->createNotFoundException($message);
    }


}
