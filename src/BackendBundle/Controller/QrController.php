<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\Qr;
//use Overall\Bundle\SSRI\AdminBundle\Form\ActividadType;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class QrController extends Controller {

    public function indexAction()
    {
        return $this->render(
            'BackendBundle:Qr:index.html.twig',
            array(
                'form' => '',
            )
        );

    }

    public function listAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_LIST_QR')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('MainBundle:Qr')->findAll();

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $entities,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('qr_data'))
        );

        return $this->render(
            'BackendBundle:Qr:list.html.twig',
            array(
                'entitiesJson' => $entitiesJson,
            )
        );

    }

    public function createAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_QR')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $entity = new Qr();
        $form = $this->createForm('MainBundle\Form\QrType', $entity,  array('attr' => array('class' => 'form-horizontal')));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('backend_qr_list', array('id' => $entity->getIdIncrement()));
        }

        return $this->render(
            'BackendBundle:Qr:form.html.twig',
            array(
                'formEntity' => $form->createView(),
                'action' => 'crear',
                'id' => null,
            )
        );
    }

    public function editAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_QR')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:Qr')->findOneById($id);
        $form = $this->createForm('MainBundle\Form\QrType', $entity,  array('attr' => array('class' => 'form-horizontal')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('backend_qr_list');
        }

        return $this->render(
            'BackendBundle:Qr:form.html.twig',
            array(
                'formEntity' => $form->createView(),
                'id' => $id,
                'action' => 'editar',
            )
        );
    }

    public function deleteAction(Request $request)
    {

        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_DELETE_QR')) {
            $response->status = "access-denied";
            $responseJson = json_encode($response);
            return new \Symfony\Component\HttpFoundation\Response($responseJson);
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:Qr')->findOneById($id);

        try {
            $entity->setStatus(0);
            $em->persist($entity);
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
