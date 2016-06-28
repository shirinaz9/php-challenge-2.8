<?php
namespace PhpChallenge\Bundle\TodoBundle\Entity;

use Gedmo\SoftDeleteable\SoftDeleteable;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use PhpChallenge\Component\Todo\TodoListInterface;

class TodoItem extends \PhpChallenge\Component\Todo\TodoItem implements SoftDeleteable
{
    protected $id;
    protected $list;

    use SoftDeleteableEntity;

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
     * @return TodoListInterface
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param TodoListInterface $list
     */
    public function setList(TodoListInterface $list)
    {
        $this->list = $list;
    }
}
