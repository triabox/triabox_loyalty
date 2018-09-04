<?php

namespace Amateur\ObjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ObjectBundle:Default:index.html.twig', array('name' => $name));
    }
}
