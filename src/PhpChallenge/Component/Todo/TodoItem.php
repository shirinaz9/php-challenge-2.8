<?php
namespace PhpChallenge\Component\Todo;

class TodoItem implements TodoItemInterface
{
    protected $description;
    protected $status;

    /**
     * @inheritDoc
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @inheritDoc
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->status;
    }


}
