<?php

/**
 * Linked list node
 */
class LinkedListNode
{
    /**
     * @var
     */
    private $data;

    /**
     * @var LinkedListNode - next node.
     */
    private $next;

    /**
     * @var LinkedListNode - previous node.
     */
    private $previous;

    /**
     * LinkedListNode constructor.
     * @param $data - The data.
     */
    function __construct($data = null)
    {
        $this->data = $data;
        $this->next = null;
        $this->previous = null;
    }

    /**
     * Link this node after another node.
     *
     * @param LinkedListNode $previous - previous another node.
     */
    public function linkAfter(LinkedListNode $previous) : void
    {
        if (!$previous)
        {
            return;
        }

        $this->next = $previous->next;
        $this->previous = $previous;

        if ($this->next)
        {
            $this->next->previous = $this;
        }

        $previous->next = $this;
    }

    /**
     * Link out node from list.
     */
    public function linkOut() : void
    {
        if ($this->previous)
        {
            $this->previous->next = $this->next;
        }

        if ($this->next)
        {
            $this->next->previous = $this->previous;
        }

        $this->previous = null;
        $this->next = null;
    }

    /**
     * Get next node.
     *
     * @return null|LinkedListNode
     */
    public function next() : ?LinkedListNode
    {
        return $this->next;
    }

    /**
     * Get previous node.
     *
     * @return null|LinkedListNode
     */
    public function previous() : ?LinkedListNode
    {
        return $this->previous;
    }

    /**
     * Get data.
     *
     * @return The data.
     */
    public function getData()
    {
        return $this->data;
    }
}