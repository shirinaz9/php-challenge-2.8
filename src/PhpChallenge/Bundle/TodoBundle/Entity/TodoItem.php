<?php
namespace PhpChallenge\Bundle\TodoBundle\Entity;

class TodoItem extends \PhpChallenge\Component\Todo\TodoItem
{
    protected $id;
    protected $list;

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

    
}
