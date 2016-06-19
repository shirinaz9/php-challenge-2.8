<?php
namespace PhpChallenge\Bundle\UserBundle\Util;

use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Util\TokenGenerator;
use PhpChallenge\Bundle\UserBundle\Entity\User;

class UserManipulator extends \FOS\UserBundle\Util\UserManipulator
{
    /** @var TokenGenerator  */
    private $tokenGenerator;
    /** @var UserManagerInterface  */
    private $userManager;

    /**
     * UserManipulator constructor.
     * @param UserManagerInterface $userManager
     * @param TokenGenerator $tokenGenerator
     */
    public function __construct(
        UserManagerInterface $userManager,
        TokenGenerator $tokenGenerator
    ) {
        parent::__construct($userManager);
        $this->userManager = $userManager;
        $this->tokenGenerator = $tokenGenerator;
    }

    /**
     * Creates a user and returns it.
     *
     * @param string  $username
     * @param string  $password
     * @param string  $email
     * @param Boolean $active
     * @param Boolean $superadmin
     *
     * @return \FOS\UserBundle\Model\UserInterface
     */
    public function create($username, $password, $email, $active, $superadmin)
    {
        /** @var User $user */
        $user = parent::create($username, $password, $email, $active, $superadmin);

        $user->setApiToken($this->tokenGenerator->generateToken());
        $this->userManager->updateUser($user);
        return $user;
    }


}
