<?php

namespace PhpChallenge\Bundle\TodoBundle\Controller;

use PhpChallenge\Bundle\TodoBundle\Entity\TodoList;
use PhpChallenge\Bundle\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('php_challenge_todo_list');
        }
        return $this->render('PhpChallengeTodoBundle:Default:index.html.twig');
    }

    public function listAction()
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getEntityManagerForClass('PhpChallenge\Bundle\TodoBundle\Entity\TodoList');
        $repo = $em->getRepository('PhpChallenge\Bundle\TodoBundle\Entity\TodoList');
        $list = $repo->findOneBy(['owner' => $user->getId()]);

        if (!$list) {
            //create default list if it doesn't exist
            $list = new TodoList();
            $list->setOwner($user);
            $em->persist($list);
            $em->flush();
        }

        return $this->render('PhpChallengeTodoBundle:Default:list.html.twig', ['list' => $list]);
    }
}
