<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\User;
use MainBundle\Entity\Device;
use MainBundle\Entity\PhoneNumber;
use MainBundle\Entity\Session;
use MainBundle\Entity\Profile;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;


class UserController extends Controller {

    private $result = null;
    private $messageError = 'Ops! Algo salió mal. Por favor, contacte a su proveedor (user)';
    private $messageSuccess = 'Proceso satisfactorio';
    private $messageException = 'NO_HUBO_ACCION';
    private $statusSuccess = 1;
    private $statusWarning = 2;
    private $statusError = 3;
    private $response;
    private $statusCode;
    private $em;

    private function response($result, $statusCode){
        $response = new Response();
        $response->setContent(json_encode($result));
        $response->headers->set('Location', 'api/user');
        $response->headers->set('Content-Type', 'application/json');

        switch($statusCode){
            case Response::HTTP_OK:
                $response->setStatusCode(Response::HTTP_OK);
                break;
            case Response::HTTP_BAD_REQUEST:
                $response->setStatusCode(Response::HTTP_BAD_REQUEST);
                break;
            default:
                $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
                break;
        }

        return $response;
    }

    public function loginAction(Request $request)
    {

        try{

            $content = $request->headers->get('Content-Type');

            if (0 === strpos($content, 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $email = $data['email'];
                $dni = $data['dni'];
                $password = $data['password'];
                $deviceCode = $data['device_code'];
                $deviceOs = $data['device_os'];
            }

            $em = $this->getDoctrine()->getManager();

            if(!empty($dni)){

                $user = $this->getUserDataByDniEmail($dni, $email);
                if(is_null($user)) {
                    $result = [
                        'status' => $this->statusWarning,
                        'message' => "error",
                        'errors' => [
                            'code' => 2,
                            'msg' => 'Usuario no existe',
                        ],
                    ];
                    return $this->response($result, Response::HTTP_BAD_REQUEST);
                }

                $user = $this->authUser($user, $dni, $password);

                if(is_null($user)){
                    $result = array(
                        'status'=>$this->statusWarning,
                        'message'=>"error",
                        'errors' => [
                            'code' => 3,
                            'msg' => 'El usuario existe, pero la contraseña no es correcta',
                        ],
                    );
                    return $this->response($result, Response::HTTP_BAD_REQUEST);
                }

            }elseif(!empty($email)){

                $user = $this->getUserDataByDniEmail($dni, $email);
                if(is_null($user)) {
                    $result = array(
                        'status' => $this->statusWarning,
                        'message' => "error",
                        'errors' => [
                            'code' => 4,
                            'msg' => 'Email incorrecto',
                        ]
                    );
                    return $this->response($result, Response::HTTP_OK);
                }
            }

            //save user
            $user->setDeviceCode($deviceCode);
            $user->setDeviceOs($deviceOs);
            $em->persist($user);
            $em->flush();
            //save user


            //eliminar - guardar la session
            $session = $em->getRepository('MainBundle:Session')->findOneByUser($user);
            if($session){
                $em->remove($session);
            }
            $session = new Session();
            $session->setUser($user);
            $em->persist($session);
            $em->flush();
            //eliminar - guardar la session


            $result = array(
                'status' => $this->statusSuccess,
                'message' => $this->messageSuccess,
                'token' => $session->getIdIncrement(),
                'user' => $user->getData(),
                'permission' => $user->getRoles(),
            );
            $statusCode = Response::HTTP_OK;

        }catch(Exception $e){
            $statusCode = Response::HTTP_BAD_REQUEST;
            $result = [
                'status'=>$this->statusError,
                'message'=>$this->messageError,
            ];
        }

        return $this->response($result, $statusCode);

    }

    public function logoutAction(Request $request)
    {

        try{

            $content = $request->headers->get('Content-Type');
            $authorization = $request->headers->get('Authorization');
            $token = str_replace('token=', '', $authorization);

            if (0 === strpos($content, 'application/json')) {
                //$data = json_decode($request->getContent(), true);
            }

            $user = $this->getUserData($token);

            if(is_null($user)){
                $result = array(
                    'status'=>$this->statusWarning,
                    'message'=>"Usuario no encontrado",
                );
                return $this->response($result, Response::HTTP_OK);
            }

            //####eliminar la session
            $em = $this->getDoctrine()->getManager();
            $session = $em->getRepository('MainBundle:Session')->findOneByUser($user);
            if($session){
                $em->remove($session);
                $em->flush();
            }
            //####eliminar la session

            $result = array(
                'status' => $this->statusSuccess,
                'message' => $this->messageSuccess,
            );
            $statusCode = Response::HTTP_OK;

        }catch(Exception $e){
            $statusCode = Response::HTTP_BAD_REQUEST;
            $result = [
                'status'=>$this->statusError,
                'message'=>$this->messageError,
            ];
        }

        return $this->response($result, $statusCode);

    }

    public function testAction(Request $request)
    {

        /*
        //guardar device
        $em = $this->getDoctrine()->getManager();
//            $device = $em->getRepository('MainBundle:Device')->findOneByUser($user);
//
        $email = 'ndulanto@hotmail.com';
        $user = $this->getUserDataByEmail($email);
        */


//
        //$data = $request->getContent();
        $data = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('MainBundle:Profile')->find(3);
        $user = new User();
        $user->setProfile($profile);
        $form = $this->createForm('MainBundle\Form\UserType', $user);
        $form->submit($data);

        //validator
        $validator = $this->get('validator');
        $errors = $validator->validate($user);
//
//        $error = [];
//        foreach($errors as $key => $value){
//            $error[] = $value->getMessage();
//        }
//
//        if (count($errors) > 0) {
//            $result = array(
//                'status'=>$this->statusWarning,
//                'message'=>"hubo errores",
//                'errors'=> $error,
//            );
//            return $this->response($result, Response::HTTP_BAD_REQUEST);
//        }
//        //validator
//
//        $em->persist($user);
//        $em->flush();
//
//        return new \Symfony\Component\HttpFoundation\Response('1');
//
//


    }

    public function createAction(Request $request)
    {

        try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $password = $data['password'];
                $email = $data['email'];
            }

            $em = $this->getDoctrine()->getManager();

            $user = $this->getUserDataByDniEmail2('', $email);
            if($user) {
                $form = $this->createForm('MainBundle\Form\UserType', $user);
                $form->submit($data);

            }else{
                $user = new User();
                $form = $this->createForm('MainBundle\Form\UserType', $user);
                $form->submit($data);

                //encryptar password
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $passwordEncode = $encoder->encodePassword($password, $user->getSalt());
                $user->setPassword($passwordEncode);
                //encryptar password

            }

            //agregar perfil
            $profile = $em->getRepository('MainBundle:Profile')->find(1);
            $user->setProfile($profile);


            //#####valida el objeto user
            $validator = $this->get('validator');
            $errors = $validator->validate($user);

            $error = [];
            foreach($errors as $key => $value){
                $error[] = $value->getMessage();
            }

            if (count($errors) > 0) {
                $result = array(
                    'status'=>$this->statusWarning,
                    'message'=>"hubo errores",
                    'errors'=> $error,
                );
                return $this->response($result, Response::HTTP_BAD_REQUEST);
            }
            //#####valida el objeto user

            $em->persist($user);
            $em->flush();

            $result = array(
                'status'=>$this->statusSuccess,
                'message'=>$this->messageSuccess,
                'user'=> $user->getData(),
            );
            $statusCode = Response::HTTP_OK;

        }catch(Exception $e){
            $statusCode = Response::HTTP_BAD_REQUEST;
            $result = [
                'status'=>$this->statusError,
                'message'=>$this->messageError,
            ];
        }

        return $this->response($result, $statusCode);

    }

    public function updateAction(Request $request)
    {

        try{
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $email = $data['email'];
                $password = $data['password'];
            }

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('MainBundle:User')->findOneBy(
                array(
                    'email' => $email,
                    'status'  => true
                )
            );

            if(is_null($user)){
                $result = array(
                    'status'=>$this->statusWarning,
                    'message'=>"Usuario no encontrado",
                );
                return $this->response($result, Response::HTTP_BAD_REQUEST);
            }

            $form = $this->createForm('MainBundle\Form\UserType', $user);
            $form->submit($data);

            //encryptar password
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $passwordEncode = $encoder->encodePassword($password, $user->getSalt());
            $user->setPassword($passwordEncode);
            //encryptar password



            //agregar perfil
            $profile = $em->getRepository('MainBundle:Profile')->find(1);
            $user->setProfile($profile);


            //#####valida el objeto user
            $validator = $this->get('validator');
            $errors = $validator->validate($user);

            $error = [];
            foreach($errors as $key => $value){
                $error[] = $value->getMessage();
            }

            if (count($errors) > 0) {
                $result = array(
                    'status'=>$this->statusWarning,
                    'message'=>"hubo errores",
                    'errors'=> $error,
                );
                return $this->response($result, Response::HTTP_BAD_REQUEST);
            }
            //#####valida el objeto user

            $em->persist($user);
            $em->flush();

            $result = array(
                'status'=>$this->statusSuccess,
                'message'=>$this->messageSuccess,
                //'device'=> $device->getIdIncrement(),
            );
            $statusCode = Response::HTTP_OK;

        }catch(Exception $e){
            $statusCode = Response::HTTP_BAD_REQUEST;
            $result = [
                'status'=>$this->statusError,
                'message'=>$this->messageError,
            ];
        }

        return $this->response($result, $statusCode);

    }

    private function authUser($userPre, $dni, $password){
        $em = $this->getDoctrine()->getManager();
        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($userPre);
        $passwordEncode = $encoder->encodePassword($password, $userPre->getSalt());

        $user = $em->getRepository('MainBundle:User')->login($dni, $passwordEncode);

        return $user;
    }

    private function validarImei($user, $imei){

        return true;

        if ($imei != "" && $user->getImei() != "") {
            if ($user->getImei() != $imei)
                return false;
        }

        return true;

    }

    private function getUserDataByDniEmail($dni, $email)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('MainBundle:User')->findOneByDniEmail($dni, $email);

        return $user;
    }

    private function getUserDataByDniEmail2($dni, $email)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('MainBundle:User')->findOneByDniEmail2($dni, $email);

        return $user;
    }

    private function getUserData($token)
    {
        $user = null;
        $em = $this->getDoctrine()->getManager();
        $session = $em->getRepository('MainBundle:Session')->findOneById($token);

        if($session)
            $user = $session->getUser();

        return $user;
    }



}
