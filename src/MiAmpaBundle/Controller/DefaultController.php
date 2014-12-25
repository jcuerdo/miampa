<?php

namespace MiAmpaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MiAmpaBundle:Default:index.html.twig', array('name' => 'Jorge'));
    }
}
