<?php

namespace PhpChallenge\Bundle\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PhpChallengeTodoBundle:Default:index.html.twig');
    }
}
