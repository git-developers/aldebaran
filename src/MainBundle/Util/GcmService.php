<?php

namespace MainBundle\Util;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;
use \Symfony\Component\Validator\Constraints\Type;
use Doctrine\ORM\Query\ResultSetMapping;

class GcmService
{

    private $container;
    private $em;

    /**
     * Constructor
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
        //$this->validator = $this->container->get('validator');
    }

    public function send($gcm)
    {

        try {

//            $deviceCode = $gcm->getDeviceCodes();
            $deviceCode = $gcm->getUser()->getDeviceCode();

            if(empty($deviceCode))
                return 'Error: Device no existe';

            $url = 'https://android.googleapis.com/gcm/send';

            $data = array(
                'to' => $deviceCode, // one user
//                'registration_ids' => $deviceCode, // array de users
                'priority' => 'high',
                'notification' => array(
                    'sound' => $gcm->getSound(),
                    'badge' => $gcm->getBadge(),
                    'title' => $gcm->getTitle(),
                    'body' => $gcm->getBody(),
                    'icon' => $gcm->getIcon(),
                    'color' => $gcm->getColor(),
                    'click_action' => $gcm->getClickAction(),
                ),
                'data' => array(
                    'info' => 'Pollos',
                )
            );

            $headers = array(
                'Authorization: key='.$this->container->getParameter('parameter_google_api_key'),
                'Content-Type: application/json'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                $error = array('error_curl' => curl_error($ch));
                $response = array_merge($response, $error);
            }

            curl_close($ch);

            $response_json = json_decode($response);


        }catch (Exception $e){
            $response_json = 'Exception Try: '.$e->getMessage();
        }

        return $response_json;

    }


}