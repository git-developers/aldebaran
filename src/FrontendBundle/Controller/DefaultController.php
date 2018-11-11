<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\Banner;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
//        $categories = $em->getRepository('MainBundle:Category')->findAll();
//        $banners = $em->getRepository('MainBundle:Banner')->findAllDisplayLimit(Banner::MAX_RESULTS_3);

        return $this->render(
            'FrontendBundle:Default:index.html.twig',
            array(
                'categories' => '',
            )
        );

    }

    public function accessDeniedAction()
    {

        return $this->render(
            'FrontendBundle:Default:accessDenied.html.twig',
            array(
                'notDisplaySection1' => true,
            )
        );
    }



}
