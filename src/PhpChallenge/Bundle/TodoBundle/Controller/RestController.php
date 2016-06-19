<?php
namespace PhpChallenge\Bundle\TodoBundle\Controller;

use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use PhpChallenge\Bundle\TodoBundle\Entity\TodoList;
use PhpChallenge\Bundle\UserBundle\Entity\User;


class RestController extends FOSRestController
{
    /** @var EntityRepository  */
    protected $todoListRepository;

    /**
     * RestController constructor.
     * @param EntityRepository $todoListRepository
     */
    public function __construct(EntityRepository $todoListRepository)
    {
        $this->todoListRepository = $todoListRepository;
    }

    /**
     * Return the overall todo list for a user.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall User List",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the user is not found"
     *   }
     * )
     *
     * @return View
     */
    public function getListAction()
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        $em = $this->getDoctrine()->getManagerForClass('PhpChallenge\Bundle\TodoBundle\Entity\TodoList');
        $repo = $em->getRepository('PhpChallenge\Bundle\TodoBundle\Entity\TodoList');
        $list = $repo->findOneBy(['owner' => $user->getId()]);

        if (!$list) {
            //create default list if it doesn't exist
            $list = new TodoList();
            $list->setOwner($user);
            $em->persist($list);
            $em->flush();
        }

        return $list;
    }
}
