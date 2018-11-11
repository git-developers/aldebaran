<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('BackendBundle:Default:index.html.twig');
    }

    public function testAction()
    {
        return $this->render('BackendBundle:Default:test.html.twig');
    }


}
