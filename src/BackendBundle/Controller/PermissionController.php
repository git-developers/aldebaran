<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\Permission;
//use Overall\Bundle\SSRI\AdminBundle\Form\ActividadType;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class PermissionController extends Controller {

    public function indexAction()
    {

        return $this->render(
            'BackendBundle:Permission:index.html.twig',
            array(
                'form' => '',
            )
        );

    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $permissions = $em->getRepository('MainBundle:Permission')->findAll();

        $serializer = $this->container->get('jms_serializer');
        $permissionsJson = $serializer->serialize(
            $permissions,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('permission_data'))
        );

        return $this->render(
            'BackendBundle:Permission:list.html.twig',
            array(
                'permissionsJson' => $permissionsJson,
            )
        );

    }

    public function createAction(Request $request)
    {
        $permission = new Permission();
        $form = $this->createForm('MainBundle\Form\PermissionType', $permission,  array('attr' => array('class' => 'form-horizontal')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($permission);
            $em->flush();

            return $this->redirectToRoute('default_permission_list');
        }

        return $this->render(
            'BackendBundle:Permission:form.html.twig',
            array(
                'permissionForm' => $form->createView(),
                'action' => 'crear',
            )
        );
    }

    public function editAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $permission = $em->getRepository('MainBundle:Permission')->findOneById($id);
        $form = $this->createForm('MainBundle\Form\PermissionType', $permission,  array('attr' => array('class' => 'form-horizontal')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($permission);
            $em->flush();

            return $this->redirectToRoute('default_permission_list');
        }

        return $this->render(
            'BackendBundle:Permission:form.html.twig',
            array(
                'permissionForm' => $form->createView(),
                'id' => $id,
                'action' => 'editar',
            )
        );
    }

    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $permission = $em->getRepository('MainBundle:Permission')->findOneById($id);

        $response = new \stdClass();

        try {
            $permission->setStatus(0);
            $em->persist($permission);
            $em->flush();

            $response->status = "ok";
        }catch (\Exception $e){
            $response->status = "fail";
        }

        $response_json = json_encode($response);

        return new \Symfony\Component\HttpFoundation\Response($response_json);

    }

}
