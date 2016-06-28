<?php
namespace PhpChallenge\Component\Todo;

use Doctrine\Common\Collections\ArrayCollection;

class TodoList implements TodoListInterface
{
    protected $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * @inheritDoc
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     */
    public function setItems(array $items)
    {
        $this->items = new ArrayCollection($items);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addItem(TodoItemInterface $item)
    {
        $this->items->add($item);
        return $this;
    }


}
