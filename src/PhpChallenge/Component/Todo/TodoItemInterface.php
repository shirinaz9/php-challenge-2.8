<?php
namespace PhpChallenge\Component\Todo;

interface TodoItemInterface
{
    /**
     * @param $description
     * @return TodoItemInterface
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param $status
     * @return TodoItemInterface
     */
    public function setStatus($status);

    /**
     * @return string
     */
    public function getStatus();
}
