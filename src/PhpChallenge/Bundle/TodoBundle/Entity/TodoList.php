<?php
namespace PhpChallenge\Bundle\TodoBundle\Entity;

use PhpChallenge\Bundle\UserBundle\Entity\User;

class TodoList extends \PhpChallenge\Component\Todo\TodoList
{
    protected $id;
    protected $owner;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     * @return $this
     */
    public function setOwner(User $owner)
    {
        $this->owner = $owner;
        return $this;
    }
}
