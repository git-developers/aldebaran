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

class ProfileController extends Controller {

    public function indexAction()
    {

        return $this->render(
            'BackendBundle:Profile:index.html.twig',
            array(
                'form' => '',
            )
        );

    }

    public function listAction()
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_LIST_PROFILE')) {
            return $this->redirectToRoute('frontend_default_access_denied');
            //throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $profiles = $em->getRepository('MainBundle:Profile')->findAll();

        $serializer = $this->container->get('jms_serializer');
        $profilesJson = $serializer->serialize(
            $profiles,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('profile_data'))
        );

        return $this->render(
            'BackendBundle:Profile:list.html.twig',
            array(
                'profilesJson' => $profilesJson,
            )
        );

    }

    public function createAction(Request $request)
    {

        /*
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_PROFILE')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }
        */

        $entity = new Profile();
        $form = $this->createForm('MainBundle\Form\ProfileType', $entity,  array('attr' => array('class' => 'form-horizontal')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('backend_profile_list');
        }

        return $this->render(
            'BackendBundle:Profile:form.html.twig',
            array(
                'formEntity' => $form->createView(),
                'action' => 'crear',
                'id' => null,
            )
        );
    }

    public function editAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_PROFILE')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:Profile')->find($id);
        $form = $this->createForm('MainBundle\Form\ProfileType', $entity,  array('attr' => array('class' => 'form-horizontal')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('backend_profile_list');
        }

        return $this->render(
            'BackendBundle:Profile:form.html.twig',
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

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_DELETE_PROFILE')) {
            $response->status = "access-denied";
            $responseJson = json_encode($response);
            return new \Symfony\Component\HttpFoundation\Response($responseJson);
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('MainBundle:Profile')->find($id);

        try {
            $profile->setStatus(0);
            $em->persist($profile);
            $em->flush();

            $response->status = "ok";
        }catch (\Exception $e){
            $response->status = "fail";
        }

        $response_json = json_encode($response);

        return new \Symfony\Component\HttpFoundation\Response($response_json);

    }

}
