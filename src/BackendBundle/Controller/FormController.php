<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\ElementType;
use MainBundle\Entity\Event;
use MainBundle\Entity\Form;
//use Overall\Bundle\SSRI\AdminBundle\Form\ActividadType;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class FormController extends Controller {

    public function indexAction()
    {

        return $this->render(
            'BackendBundle:Form:index.html.twig',
            array(
                'form' => '',
            )
        );

    }

    public function listAction()
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_LIST_FORM')) {
            return $this->redirectToRoute('frontend_default_access_denied');
            //throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('MainBundle:Form')->findAllOrderDesc();

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $entities,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('form_data'))
        );

        return $this->render(
            'BackendBundle:Form:list.html.twig',
            array(
                'entitiesJson' => $entitiesJson,
            )
        );

    }

    public function createAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_FORM')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $em = $this->getDoctrine()->getManager();
        $elementTypes = $em->getRepository('MainBundle:ElementType')->findAllByGroup(ElementType::GROUP_FORM);
        $form = new Form();
        $form->setUniqueId(uniqid());
        $formEntity = $this->createForm('MainBundle\Form\FormType', $form,  array('attr' => array('class' => 'form-horizontal')));

        return $this->render(
            'BackendBundle:Form:form.html.twig',
            array(
                'form' => $form,
                'elementTypes' => $elementTypes,
                'formEntity' => $formEntity->createView(),
                'action' => 'crear',
                'id' => null,
            )
        );
    }

    public function createUpdateAction(Request $request)
    {
        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_FORM')) {
            $response->status = "access-denied";
            return new \Symfony\Component\HttpFoundation\Response(json_encode($response));
        }

        try {

            $event = $request->get('form');
            $formUniqueId = $event['uniqueId'];

            $em = $this->getDoctrine()->getManager();
            $form = $em->getRepository('MainBundle:Form')->findOneByUniqueId($formUniqueId);

            if(is_null($form)) {
                $form = new Form();
            }

            $user = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $formEntity = $this->createForm('MainBundle\Form\FormType', $form,  array('attr' => array('class' => 'form-horizontal')));
            $formEntity->handleRequest($request);
            $form->setUser($user);
            $em->persist($form);
            $em->flush();

            // CREAR TABLAS FISICAS POR FORMULARIO
            $em->getRepository('MainBundle:Form')->createAlterPhysicalTable($form);

            $response->status = "ok";

        }catch(Exception $e){
            $response->status = "error";
        }

        return new \Symfony\Component\HttpFoundation\Response(json_encode($response));

    }

    public function editAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_FORM')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $elementTypes = $em->getRepository('MainBundle:ElementType')->findAllByGroup(ElementType::GROUP_FORM);
        $form = $em->getRepository('MainBundle:Form')->findOneById($id);
        $formEntity = $this->createForm('MainBundle\Form\FormType', $form,  array('attr' => array('class' => 'form-horizontal')));
        //$this->notFoundRedirect($entity, 'backend_default_index');

        if(!$form) {
            return $this->redirectToRoute('backend_default_index');
        }

        return $this->render(
            'BackendBundle:Form:form.html.twig',
            array(
                'form' => $form,
                'elementTypes' => $elementTypes,
                'formEntity' => $formEntity->createView(),
                'action' => 'editar',
                'id' => $id,
            )
        );
    }

    public function deleteAction(Request $request)
    {
        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_DELETE_FORM')) {
            $response->status = "access-denied";
            return new \Symfony\Component\HttpFoundation\Response(json_encode($response));
        }

        try {
            $id = $request->get('id');
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MainBundle:Form')->findOneById($id);
            $entity->setStatus(0);
            $em->persist($entity);
            $em->flush();

            $response->status = "ok";
        }catch (\Exception $e){
            $response->status = "fail";
        }

        return new \Symfony\Component\HttpFoundation\Response(json_encode($response));

    }

    public function displayAction(Request $request)
    {
        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_FORM')) {
            $response->status = "access-denied";
            return new \Symfony\Component\HttpFoundation\Response(json_encode($response));
        }

        try {
            $id = $request->get('id');
            $em = $this->getDoctrine()->getManager();
            $form = $em->getRepository('MainBundle:Form')->findOneById($id);
            $builder = $this->get('main.util.formBuilder');
            $response->form = $builder->displayForm(new Event(), $form);
            $response->status = "ok";
        }catch (Exception $e){
            $response->status = "fail";
        }

        return new \Symfony\Component\HttpFoundation\Response(json_encode($response));

    }

    public function displayHtmlAction(Event $event, Form $form)
    {

        $builder = $this->get('main.util.formBuilder');
        return new \Symfony\Component\HttpFoundation\Response($builder->displayForm($event, $form));
    }

    private function notFoundException($entity, $message)
    {
        if(!$entity)
            throw $this->createNotFoundException($message);
    }

    public function updatePositionAction(Request $request)
    {
        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_FORM')) {
            $response->status = "access-denied";
            $responseJson = json_encode($response);
            return new \Symfony\Component\HttpFoundation\Response($responseJson);
        }

        try {

            /*
            $hash = $request->get('hash');
            $em = $this->getDoctrine()->getManager();

            foreach($hash as $idElement => $position){
                $entity = $em->getRepository('MainBundle:Form')->findOneById($idElement);
                $entity->setPosition($position);
                $em->persist($entity);
                $em->flush();
            }
            */

            $response->status = "ok";
        }catch (\Exception $e){
            $response->status = "fail";
        }

        return new \Symfony\Component\HttpFoundation\Response(json_encode($response));

    }


}
