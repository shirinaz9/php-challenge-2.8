<?php
namespace PhpChallenge\Bundle\UserBundle\Behat;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserInterface;
use PhpChallenge\Bundle\TodoBundle\Entity\TodoList;
use PhpChallenge\Bundle\UserBundle\Entity\User;

class UserContext extends RawMinkContext implements KernelAwareContext, Context
{
    use KernelDictionary;

    protected static $user;

    /**
     * Get service by id.
     *
     * @param string $id
     *
     * @return object
     */
    protected function getService($id)
    {
        $this->getKernel()->boot();
        return $this->getContainer()->get($id);
    }

    /**
     * @Given /^I am authenticated as user "([^"]*)" with token "([^"]*)"$/
     */
    public function iAmAuthenticatedAs($username, $apiToken)
    {
        $user = $this->thereIsAUser($username, $apiToken);
        self::$user = $user;

        return $user;
    }

    /**
     * @Given there is a user :username
     */
    public function thereIsAUser($username, $apiToken = null)
    {
        /** @var EntityManager $em */
        $em = $this->getService('doctrine')->getManager();
        $repo = $em->getRepository('PhpChallengeUserBundle:User');
        
        if ($user = $repo->findOneBy(['username' => $username])) {
            self::$user = $user;

            return $user;
        }

        $user = new User();
        $user->setRoles([UserInterface::ROLE_DEFAULT]);
        $user->setEnabled(true);
        $user->setEmail('thisisatest@test.com');
        $user->setPassword('testpass');
        $user->setUsername($username);
        $user->setApiToken($apiToken);

        $list = new TodoList();
        $list->setOwner($user);

        $em->persist($user);
        $em->persist($list);
        $em->flush();

        return $user;
    }
}
