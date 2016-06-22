<?php
namespace PhpChallenge\Bundle\TodoBundle\Controller;

use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use PhpChallenge\Bundle\TodoBundle\Entity\TodoItem;
use PhpChallenge\Bundle\TodoBundle\Entity\TodoList;
use PhpChallenge\Bundle\TodoBundle\Form\Type\TodoItemFormType;
use PhpChallenge\Bundle\UserBundle\Entity\User;
use PhpChallenge\Component\Todo\TodoListInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ApiController extends FOSRestController
{
    /** @var EntityRepository  */
    protected $todoListRepository;
    /** @var EntityRepository  */
    protected $todoListItemRepository;

    /**
     * RestController constructor.
     * @param EntityRepository $todoListRepository
     * @param EntityRepository $todoListItemRepository
     */
    public function __construct(
        EntityRepository $todoListRepository,
        EntityRepository $todoListItemRepository
    ) {
        $this->todoListRepository = $todoListRepository;
        $this->todoListItemRepository = $todoListItemRepository;
    }

    /**
     * Return the overall todo list for a user.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall Todo List",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the list is not found"
     *   }
     * )
     *
     * @return View
     */
    public function getListAction()
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $list = $this->todoListRepository->findOneBy(['owner' => $user->getId()]);

        if (!$list) {
            //create default list if it doesn't exist
            $list = new TodoList();
            $list->setOwner($user);

            $em = $this->getDoctrine()->getManagerForClass('PhpChallenge\Bundle\TodoBundle\Entity\TodoList');
            $em->persist($list);
            $em->flush();
        }

        return $this->handleView($this->view($list));
    }

    /**
     * Return the overall todo list item for a user.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return a specific list item",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the list item is not found"
     *   }
     * )
     *
     * @return View
     */
    public function getListItemAction($itemId)
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $list = $this->todoListRepository->findOneBy(['owner' => $user->getId()]);

        $item = $this->todoListItemRepository->findOneBy(['list' => $list, 'id' => $itemId]);
        return $this->handleView($this->view($item));
    }


    public function createListItemAction(Request $request)
    {
        $item = new TodoItem();

        $form = $this->createForm(TodoItemFormType::class, $item);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            /** @var TodoListInterface $list */
            $list = $this->todoListRepository->findOneBy(['owner' => $user->getId()]);

            $item->setList($list);
            $list->addItem($item);

            $em = $this->getDoctrine()->getManagerForClass('PhpChallenge\Bundle\TodoBundle\Entity\TodoItem');
            $em->persist($list);
            $em->persist($item);
            $em->flush();

            return $this->handleView($this->view($item, 201));
        }

        return $this->handleView($this->view($form));
    }
}
