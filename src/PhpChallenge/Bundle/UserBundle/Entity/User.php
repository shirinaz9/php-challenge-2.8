<?php
namespace PhpChallenge\Bundle\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Security\Core\User\UserInterface;

class User extends BaseUser implements UserInterface
{
    protected $id;

    protected $apiToken;

    /**
     * @return string
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param string $apiToken
     */
    public function setApiToken($apiToken)
    {
        $this->apiToken = $apiToken;
    }
}
