<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MainBundle\Entity\Section;

class VideoController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $videos = $em->getRepository('MainBundle:Video')->findAllPublic();

        if ($this->get('security.authorization_checker')->isGranted('ROLE_VIEW_PRIVATE_POST')) {
            $videos = $em->getRepository('MainBundle:Video')->findAll();
        }

        return $this->render(
            'FrontendBundle:Video:index.html.twig',
            array(
                'notDisplaySection1' => true,
                'videos' => $videos,
            )
        );

    }

    public function detailAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('MainBundle:Video')->findOneById($id);

        if(!$video){
            return $this->redirectToRoute('frontend_default_index');
        }

        if ($video->isGrantedPrivate() && !$this->get('security.authorization_checker')->isGranted('ROLE_VIEW_PRIVATE_POST')) {
            return $this->redirectToRoute('frontend_default_access_denied');
        }

        return $this->render(
            'FrontendBundle:Video:detail.html.twig',
            array(
                'notDisplaySection1' => true,
                'video' => $video,
            )
        );

    }



}
