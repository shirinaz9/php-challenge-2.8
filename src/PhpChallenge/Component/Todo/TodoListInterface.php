<?php
namespace PhpChallenge\Component\Todo;

interface TodoListInterface
{
    /**
     * @return TodoItemInterface[]
     */
    public function getItems();

    /**
     * @param TodoItemInterface[] $items
     * @return TodoListInterface
     */
    public function setItems(array $items);

    /**
     * @param TodoItemInterface $item
     * @return TodoListInterface
     */
    public function addItem(TodoItemInterface $item);
}
