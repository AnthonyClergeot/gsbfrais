<?php

namespace ACYG\GsbFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ACYGGsbFraisBundle:Default:index.html.twig', array('name' => $name));
    }
}
