<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\User;
//use Overall\Bundle\SSRI\AdminBundle\Form\ActividadType;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class UserController extends Controller {

    public function indexAction()
    {

        return $this->render(
            'BackendBundle:User:index.html.twig',
            array(
                'form' => '',
            )
        );

    }

    public function listAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_LIST_USER')) {
            return $this->redirectToRoute('frontend_default_access_denied');
            //throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('MainBundle:User')->findAll();

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $entities,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('user_data'))
        );

        return $this->render(
            'BackendBundle:User:list.html.twig',
            array(
                'entitiesJson' => $entitiesJson,
            )
        );

    }

    public function createAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_USER')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $entity = new User();
        $form = $this->createForm('MainBundle\Form\UserType', $entity,  array('attr' => array('class' => 'form-horizontal')));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //encryptar password
            $password = $form->get('password')->getData();
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($entity);
            $passwordEncode = $encoder->encodePassword($password, $entity->getSalt());
            $entity->setPassword($passwordEncode);
            //encryptar password

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('backend_user_list', array('id' => $entity->getIdIncrement()));
        }

        return $this->render(
            'BackendBundle:User:form.html.twig',
            array(
                'formEntity' => $form->createView(),
                'action' => 'crear',
                'id' => null,
            )
        );
    }

    public function editAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_USER')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:User')->findOneByIdIncrement($id);
        $oldPassword = $entity->getPassword();
        $form = $this->createForm('MainBundle\Form\UserType', $entity,  array('attr' => array('class' => 'form-horizontal')));
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            //encryptar password
            $newPassword = $form->get('password')->getData();

            if(!empty($newPassword)) {
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($entity);
                $passwordEncode = $encoder->encodePassword($newPassword, $entity->getSalt());
                $entity->setPassword($passwordEncode);
            }else{
                $entity->setPassword($oldPassword);
            }
            //encryptar password

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('backend_user_list');
        }

        return $this->render(
            'BackendBundle:User:form.html.twig',
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

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_DELETE_USER')) {
            $response->status = "access-denied";
            $responseJson = json_encode($response);
            return new \Symfony\Component\HttpFoundation\Response($responseJson);
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:User')->findOneById($id);

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
