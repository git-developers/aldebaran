<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\Files;
use MainBundle\Entity\FilesMimeType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

class FilesController extends Controller {

    public function indexAction()
    {

        return $this->render(
            'BackendBundle:Files:index.html.twig',
            array(
                'form' => '',
            )
        );

    }

    public function listAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_LIST_FILES')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('MainBundle:Files')->findAll();

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $entities,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('files_data'))
        );

        return $this->render(
            'BackendBundle:Files:list.html.twig',
            array(
                'entitiesJson' => $entitiesJson,
            )
        );
    }

    public function listAjaxAction(Request $request)
    {
        $mimeType = $request->get('mimeType');
        $mimeType = explode(",", $mimeType);

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('MainBundle:Files')->findAllByType($mimeType);

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $entities,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('files_data'))
        );

        return $this->render(
            'BackendBundle:Files:listPartial.html.twig',
            array(
                'entitiesJson' => $entitiesJson,
            )
        );
    }

    public function createAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_FILES')) {
            throw $this->createAccessDeniedException();
        }

        return $this->render(
            'BackendBundle:Files:formCreate.html.twig',
            array(
                'action' => 'crear',
                'id' => null,
            )
        );
    }

    public function uploadAction(Request $request) // $_SERVER $_FILES
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_CREATE_FILES')) {
            throw $this->createAccessDeniedException();
        }

        if($request->isMethod('GET')) {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MainBundle:Files')->findAll();
            $array = [];

            foreach($entity as $key => $value){
                $response = new \stdClass();
                $response->status = 'ok';
                $response->deleteType = 'DELETE';
                $response->deleteUrl = 'delete?id=' . $value->getIdIncrement();
                $response->name = $value->getOriginalName();
                $response->size = 123;
                $response->mimeType = $value->getFilesMimeType()->getType();
                $response->viewer = $value->getFilesMimeType()->getViewer();
                $response->thumbnailUrl = $value->getName();
                $response->type = 'image/png';
                $response->url = $value->getName();
                $array[] = $response;
            }

            $out = [
                'files' => $array
            ];

            $response_json = json_encode($out);
        }

        if($request->isMethod('POST')) {

            $name = $_FILES['files']['name'][0];
            $datetime = (new \DateTime())->format('Y_m_d');
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $originalName = $datetime . '_' . uniqid() . '.' . $ext;

            $mimeType = $_FILES['files']['type'][0];
            $size = $_FILES['files']['size'][0];
            $error = $_FILES['files']['error'][0];
            $pathName = $_FILES['files']['tmp_name'][0];

            $user = $this->getUser();
            $filesMimeType = $this->getFilesMimeType($mimeType);
            $uploadedFile = new UploadedFile($pathName, $originalName, $mimeType, $size, $error);
            $files = new Files();
            $files->setUser($user);
            $files->setFilesMimeType($filesMimeType);
            $files->setName($originalName);
            $files->setOriginalName($name);
            $files->setSize($size);
            $files->setFile($uploadedFile);
            $files->upload();

            $em = $this->getDoctrine()->getManager();
            $em->persist($files);
            $em->flush();

            $response = new \stdClass();
            $response->status = 'ok';
            $response->deleteType = 'DELETE';
            $response->deleteUrl = 'delete?id=' . $files->getIdIncrement();
            $response->name = $name;
            $response->size = $size;
            $response->mimeType = $files->getFilesMimeType()->getType();
            $response->viewer = $files->getFilesMimeType()->getViewer();
            $response->thumbnailUrl = $originalName;
            $response->type = $mimeType;
            $response->url = $files->getAbsolutePath();

            $out = [
                'files' => [
                    $response
                ]
            ];

            $response_json = json_encode($out);
        }

        return new \Symfony\Component\HttpFoundation\Response($response_json);
    }

    private function getFilesMimeType($mimeType)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:FilesMimeType')->findOneByMimeType($mimeType);

        if($entity == null){
            $entity = new FilesMimeType();
        }

        $entity->setMimeType($mimeType);
        $em->persist($entity);
        $em->flush();

        return $entity;

    }

    public function editAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_FILES')) {
            throw $this->createAccessDeniedException();
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:Files')->findOneById($id);
        $form = $this->createForm('MainBundle\Form\FilesType', $entity,  array('attr' => array('class' => 'form-horizontal')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('backend_files_list');
        }

        return $this->render(
            'BackendBundle:Files:formEdit.html.twig',
            array(
                'formEntity' => $form->createView(),
                'action' => 'editar',
                'id' => $id,
            )
        );
    }

    public function deleteAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_DELETE_FILES')) {
            throw $this->createAccessDeniedException();
        }

        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:Files')->findOneByIdIncrement($id);

        $response = new \stdClass();

        try {

            $em->remove($entity);
            $em->flush();

            if(file_exists($entity->getAbsolutePath())) {
                unlink($entity->getAbsolutePath());
            }

            $response->status = 'ok';
        }catch (Exception $e){
            $response->status = 'fail';
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
