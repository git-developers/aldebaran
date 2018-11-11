<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\Event;
use MainBundle\Entity\EventHasForm;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class EventController extends Controller {

    public function indexAction()
    {

        return $this->render(
            'BackendBundle:Event:index.html.twig',
            array(
                'Event' => '',
            )
        );

    }

    public function listAction()
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_LIST_EVENT')) {
            return $this->redirectToRoute('frontend_default_access_denied');
            //throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('MainBundle:Event')->findAllOrderDesc();

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $entities,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('event_data'))
        );

        return $this->render(
            'BackendBundle:Event:list.html.twig',
            array(
                'entitiesJson' => $entitiesJson,
            )
        );

    }

    public function createAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_EVENT')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $em = $this->getDoctrine()->getManager();
        $forms = $em->getRepository('MainBundle:Form')->findAllOrderAsc();
        $event = new Event();
        $event->setUniqueId(uniqid());
        $form = $this->createForm('MainBundle\Form\EventType', $event,  array('attr' => array('class' => 'form-horizontal')));

        return $this->render(
            'BackendBundle:Event:form.html.twig',
            array(
                'event' => $event,
                'forms' => $forms,
                'formEntity' => $form->createView(),
                'action' => 'crear',
                'id' => null,
            )
        );
    }

    public function createUpdateAction(Request $request)
    {

        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_EVENT')) {
            $response->status = "access-denied";
            $responseJson = json_encode($response);
            return new \Symfony\Component\HttpFoundation\Response($responseJson);
        }

        $response->status = "error";

        try {

            $saveEventForm = $request->get('saveEventForm');
            $data = $request->get('event');
            $uniqueId = $data['uniqueId'];

            $em = $this->getDoctrine()->getManager();
            $event = $em->getRepository('MainBundle:Event')->findOneByUniqueId($uniqueId);

            if(is_null($event)) {
                $event = new Event();
            }

            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm('MainBundle\Form\EventType', $event,  array('attr' => array('class' => 'form-horizontal')));
            $form->handleRequest($request);
            $event->setUser($this->getUser());
            $em->persist($event);
            $em->flush();


            //tabla associative
            $eventHasForm = $em->getRepository('MainBundle:EventHasForm')->findAllByEvent($event);

            foreach ($eventHasForm as $key => $value) {
                $em->remove($value);
            }

            $em->flush();

            foreach($data['event_form'] as $key => $value){
                $form = $em->getRepository('MainBundle:Form')->findOneById($value);
                $eventHasForm = new EventHasForm();
                $eventHasForm->setEvent($event);
                $eventHasForm->setForm($form);
                $em->persist($eventHasForm);
            }

            $em->flush();
            //tabla associative


            // insert - update tablas fisicas
            $insert = $em->getRepository('MainBundle:Event')->insertUpdatePhysicalTable($saveEventForm, $event);

            if($insert){
                $response->status = "ok";
            }

        }catch(Exception $e){
            $response->status = "error";
        }

        return new \Symfony\Component\HttpFoundation\Response(json_encode($response));

    }

    public function editAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_EVENT')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $forms = $em->getRepository('MainBundle:Form')->findAllOrderAsc();
        $event = $em->getRepository('MainBundle:Event')->findOneById($id);
        //$eventHasForm = $em->getRepository('MainBundle:EventHasForm')->findAllByEvent($event);
        $form = $this->createForm('MainBundle\Form\EventType', $event,  array('attr' => array('class' => 'form-horizontal')));

        if(!$event) {
            return $this->redirectToRoute('backend_default_index');
        }

        return $this->render(
            'BackendBundle:Event:form.html.twig',
            array(
                'event' => $event,
                'forms' => $forms,
                //'eventHasForm' => $eventHasForm,
                'formEntity' => $form->createView(),
                'action' => 'editar',
                'id' => $id,
            )
        );

    }

    public function deleteAction(Request $request)
    {
        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_DELETE_EVENT')) {
            $response->status = "access-denied";
            $responseJson = json_encode($response);
            return new \Symfony\Component\HttpFoundation\Response($responseJson);
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:Event')->findOneById($id);

        $response = new \stdClass();

        try {
            $entity->setStatus(0);
            $em->persist($entity);
            $em->flush();

            $response->status = "ok";
        }catch (\Exception $e){
            $response->status = "fail";
        }

        $responseJson = json_encode($response);

        return new \Symfony\Component\HttpFoundation\Response($responseJson);

    }

    private function notFoundException($entity, $message)
    {
        if(!$entity)
            throw $this->createNotFoundException($message);
    }



}
