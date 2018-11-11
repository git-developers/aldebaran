<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\News;
//use Overall\Bundle\SSRI\AdminBundle\Form\ActividadType;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class NewsController extends Controller {

    public function indexAction()
    {

        return $this->render(
            'BackendBundle:News:index.html.twig',
            array(
                'form' => '',
            )
        );

    }

    public function listAction()
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_LIST_NEWS')) {
            return $this->redirectToRoute('frontend_default_access_denied');
            //throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('MainBundle:News')->findAll();

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $entities,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('news_data'))
        );

        return $this->render(
            'BackendBundle:News:list.html.twig',
            array(
                'entitiesJson' => $entitiesJson,
            )
        );

    }

    public function createAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_NEWS')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $user = $this->getUser();
        $entity = new News();
        $form = $this->createForm('MainBundle\Form\NewsType', $entity,  array('attr' => array('class' => 'form-horizontal')));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $entity->setUser($user);
            $em->persist($entity);
            $em->flush();

            $this->get('main.util.email')->enviarEmailParaValidacionNews($entity);

            return $this->redirectToRoute('backend_news_list', array('id' => $entity->getIdIncrement()));
        }

        return $this->render(
            'BackendBundle:News:form.html.twig',
            array(
                'formEntity' => $form->createView(),
                'action' => 'crear',
                'id' => null,
            )
        );
    }

    public function editAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_NEWS')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:News')->findOneByIdIncrement($id);
        $form = $this->createForm('MainBundle\Form\NewsType', $entity,  array('attr' => array('class' => 'form-horizontal')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('backend_news_list');
        }

        return $this->render(
            'BackendBundle:News:form.html.twig',
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

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_DELETE_NEWS')) {
            $response->status = "access-denied";
            $responseJson = json_encode($response);
            return new \Symfony\Component\HttpFoundation\Response($responseJson);
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:News')->findOneByIdIncrement($id);

        $response = new \stdClass();

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
