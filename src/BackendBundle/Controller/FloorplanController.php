<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\ElementType;
use MainBundle\Entity\FloorPlan;
//use Overall\Bundle\SSRI\AdminBundle\Form\ActividadType;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

/*
 * ICONOS ;::: http://www.flaticon.com/packs/bar-glases-and-bottles
 *
 * https://www.draw.io/?demo=1
https://app2.planningpod.com
https://www.web.allseated.com/
https://www.3deventdesigner.com/project/ec79801a4dee790567d99a4bf7929289e31f0351
https://cloud.smartdraw.com/editor.aspx?templateId=0218cedc-f8be-4be9-b26d-a2d048066820#docId=Floor_Plan.sdr&ownerUserId=16936843&depo=2

 */

class FloorplanController extends Controller {

    public function indexAction()
    {

        return $this->render(
            'BackendBundle:Floorplan:index.html.twig',
            array(
                'form' => '',
            )
        );

    }

    public function listAction()
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_LIST_FLOORPLAN')) {
            return $this->redirectToRoute('frontend_default_access_denied');
            //throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('MainBundle:About')->findAll();

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $entities,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('about_data'))
        );

        return $this->render(
            'BackendBundle:Floorplan:list.html.twig',
            array(
                'entitiesJson' => $entitiesJson,
            )
        );

    }

    //https://www.sitepoint.com/building-custom-right-click-context-menu-javascript/
    public function createUpdateAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_FLOORPLAN')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $idEvent = $request->get('idEvent');
        $em = $this->getDoctrine()->getManager();
        $groups = [ElementType::GROUP_KITCHEN, ElementType::GROUP_CHAIRS, ElementType::GROUP_CATERING, ElementType::GROUP_GLASES];
        $elementTypes = $em->getRepository('MainBundle:ElementType')->findAllByGroup($groups);
        $event = $em->getRepository('MainBundle:Event')->findOneById($idEvent);
        $floorPlan = $em->getRepository('MainBundle:FloorPlan')->findOneByEvent($event);

        if(is_null($floorPlan)) {
            $floorPlan = new FloorPlan();
            $floorPlan->setEvent($event);
            $em->persist($floorPlan);
            $em->flush();
        }

        $formEntity = $this->createForm('MainBundle\Form\FloorPlanType', $floorPlan,  array('attr' => array('class' => 'form-horizontal')));

        return $this->render(
            'BackendBundle:Floorplan:form.html.twig',
            array(
                'floorPlan' => $floorPlan,
                'elementTypes' => $elementTypes,
                'formEntity' => $formEntity->createView(),
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
        $entity = $em->getRepository('MainBundle:About')->findOneByIdIncrement($id);
        $form = $this->createForm('MainBundle\Form\AboutType', $entity,  array('attr' => array('class' => 'form-horizontal')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('backend_about_list');
        }

        return $this->render(
            'BackendBundle:Floorplan:form.html.twig',
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
        $entity = $em->getRepository('MainBundle:About')->findOneByIdIncrement($id);

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
