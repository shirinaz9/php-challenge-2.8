<?php
namespace PhpChallenge\Bundle\TodoBundle\Controller;

use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;


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
        return $this->todoListRepository->findOneBy(['id' => 1]);
    }
}
