<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\Form;
use MainBundle\Entity\FloorPlan;
use MainBundle\Entity\Element;
//use Overall\Bundle\SSRI\AdminBundle\Form\ActividadType;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class ElementController extends Controller {

    public function indexAction()
    {

        return $this->render(
            'BackendBundle:Element:index.html.twig',
            array(
                'form' => '',
            )
        );

    }

    public function createAndAssignToFloorplanAction(Request $request)
    {

        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_FORM')) {
            $response->status = "access-denied";
            return new \Symfony\Component\HttpFoundation\Response(json_encode($response));
        }

        try {

            $element = $this->createAndAssignToFloorplan($request->get('elementType'), $request->get('idFloorplan'));
            $builder = $this->get('main.util.floorplanBuilder');
            $response->element = $builder->displayElement(new FloorPlan(), $element);
            $response->status = "ok";

        }catch(Exception $e){
            $response->status = "error";
        }

        return new \Symfony\Component\HttpFoundation\Response(json_encode($response));
    }

    public function createAndAssignToFormAction(Request $request)
    {

        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_FORM')) {
            $response->status = "access-denied";
            return new \Symfony\Component\HttpFoundation\Response(json_encode($response));
        }

        try {

            $element = $this->createAndAssignToForm($request->get('elementType'), $request->get('uniqueId'));
            $builder = $this->get('main.util.elementBuilder');
            $response->element = $builder->displayElement(new Form(), $element);
            $response->status = "ok";

        }catch(\Exception $e){
            $response->status = "error";
        }

        return new \Symfony\Component\HttpFoundation\Response(json_encode($response));
    }

    private function createAndAssignToForm($elementType, $formUniqueId)
    {
        $unique = uniqid();
        $em = $this->getDoctrine()->getManager();
        $type = $em->getRepository('MainBundle:ElementType')->findOneByType($elementType);

        $element = new Element();
        $element->setUniqueId($unique);
        $element->setTagId($unique);
        $element->setElementType($type);
        $element->setLabelName(Element::l($elementType));
        $element->setTagPlaceholder(Element::ph($elementType));
        $element->setTagName(str_replace('element', '', strtolower($elementType)));
        $em->persist($element);

        // asignar elemento al formulario
        $form = $em->getRepository('MainBundle:Form')->findOneByUniqueId($formUniqueId);
        $form->addElement($element);

        //agregar el elemento a la tabla fisica
        $em->getRepository('MainBundle:Form')->addOneColumn($formUniqueId, $element);

        $em->flush();

        return $element;
    }

    private function createAndAssignToFloorplan($elementType, $idFloorplan)
    {
        $unique = uniqid();
        $em = $this->getDoctrine()->getManager();
        $type = $em->getRepository('MainBundle:ElementType')->findOneByType($elementType);

        $element = new Element();
        $element->setUniqueId($unique);
        $element->setTagId($unique);
        $element->setElementType($type);
        $element->setTagName(str_replace('element', '', strtolower($elementType)));
        $em->persist($element);

        // asignar elemento al formulario
        $floorPlan = $em->getRepository('MainBundle:FloorPlan')->findOneById($idFloorplan);
        $floorPlan->addElement($element);

        $em->flush();

        return $element;
    }

    public function displayFormElementsAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_USER')) {

        }

        $response = '';

        try {
            $formUniqueId = $request->get('formUniqueId');
            $em = $this->getDoctrine()->getManager();
            $form = $em->getRepository('MainBundle:Form')->findOneByUniqueId($formUniqueId);

            if($form) {
                $builder = $this->get('main.util.elementBuilder');

                foreach ($form->getElement() as $key => $element) {
                    $response .= $builder->displayElement($form, $element);
                }
            }

        }catch(Exception $e){

        }

        return new \Symfony\Component\HttpFoundation\Response($response);
    }

    public function displayElementsByFormAction(Form $form, Element $element)
    {
        $builder = $this->get('main.util.elementBuilder');
        return new \Symfony\Component\HttpFoundation\Response($builder->displayElement($form, $element));
    }

    public function displayElementsByFloorplanAction(FloorPlan $floorPlan, Element $element)
    {
        $builder = $this->get('main.util.floorplanBuilder');
        return new \Symfony\Component\HttpFoundation\Response($builder->displayElement($floorPlan, $element));
    }

    public function editAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_FORM')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        $id = $request->get('id');

        //al actualizar ya no se tiene el id
        $element = $request->get('element');
        if(empty($id)){
            $id = $element['idIncrement'];
        }

        $em = $this->getDoctrine()->getManager();
        $element = $em->getRepository('MainBundle:Element')->findOneById($id);
        $formEntity = $this->createForm('MainBundle\Form\ElementType', $element,  array('attr' => array('class' => 'form-horizontal')));
        $formEntity->handleRequest($request);

        if ($formEntity->isSubmitted() && $formEntity->isValid()) {
            $em->persist($element);
            $em->flush();
        }

        return $this->render(
            'BackendBundle:Element:form.html.twig',
            array(
                'formEntity' => $formEntity->createView(),
            )
        );
    }

    public function updateStackOrderAction(Request $request)
    {
        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_FORM')) {
            $response->status = "access-denied";
            $responseJson = json_encode($response);
            return new \Symfony\Component\HttpFoundation\Response($responseJson);
        }

        try {

            $hash = $request->get('hash');
            $em = $this->getDoctrine()->getManager();

            foreach($hash as $idElement => $order){
                $entity = $em->getRepository('MainBundle:Element')->findOneById($idElement);
                $entity->setStackOrder($order);
                $em->persist($entity);
                $em->flush();
            }

            $response->status = "ok";
        }catch (\Exception $e){
            $response->status = "fail";
        }

        return new \Symfony\Component\HttpFoundation\Response(json_encode($response));

    }

    public function deleteAction(Request $request)
    {
        $response = new \stdClass();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_FORM')) {
            $response->status = "access-denied";
            $responseJson = json_encode($response);
            return new \Symfony\Component\HttpFoundation\Response($responseJson);
        }

        try {
            $id = $request->get('id');
            $formUniqueId = $request->get('formUniqueId');
            $em = $this->getDoctrine()->getManager();
            $element = $em->getRepository('MainBundle:Element')->findOneById($id);
            $em->remove($element);

            //eliminar un elemento de la tabla fisica
            $em->getRepository('MainBundle:Form')->dropOneColumn($formUniqueId, $element);

            $em->flush();

            $response->status = "ok";
        }catch (\Exception $e){
            $response->status = "fail";
        }

        return new \Symfony\Component\HttpFoundation\Response(json_encode($response));

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
            $idElement = $request->get('idElement');
            $positionX = $request->get('positionX');
            $positionY = $request->get('positionY');
            $em = $this->getDoctrine()->getManager();
            $element = $em->getRepository('MainBundle:Element')->findOneById($idElement);
            $element->setPositionX($positionX);
            $element->setPositionY($positionY);
            $em->persist($element);
            $em->flush();

            $response->status = "ok";
        }catch (Exception $e){
            $response->status = "fail";
        }

        return new \Symfony\Component\HttpFoundation\Response(json_encode($response));

    }

    private function notFoundException($entity, $message)
    {
        if(!$entity)
            throw $this->createNotFoundException($message);
    }





}
