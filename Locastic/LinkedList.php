<?php

require_once('LinkedListNode.php');

/**
 * Class LinkedList.
 */
class LinkedList
{
    /**
     * @var LinkedListNode - dummy head element.
     */
    protected $head;

    /**
     * @var LinkedListNode - last element. On empty list is head.
     */
    protected $last;

    /**
     * @var int - list length;
     */
    protected $length;

    /**
     * LinkedList constructor.
     */
    function __construct()
    {
        $this->head = new LinkedListNode(null);
        $this->last = $this->head;
        $this->length = 0;
    }

    /**
     * Swap nodes.
     *
     * @param LinkedListNode $node1 - first node.
     * @param LinkedListNode $node2 - second node.
     */
    protected function swap(LinkedListNode $node1,
                            LinkedListNode $node2)
    {
        if (!$node1 || !$node2)
        {
            return;
        }

        if ($node1->next() === $node2)
        {
            $node1->linkOut();
            $node1->linkAfter($node2);
        }
        else if ($node2->next() === $node1)
        {
            $node2->linkOut();
            $node2->linkAfter($node1);
        }
        else
        {
            $previous1 = $node1->previous();
            $previous2 = $node2->previous();

            if (!$previous1 or !$previous2)
            {
                return;
            }

            $node1->linkOut();
            $node2->linkOut();
            $node1->linkAfter($previous2);
            $node2->linkAfter($previous1);
        }
    }

    /**
     * Get node by index.
     *
     * @param int $index - The index.
     * @return LinkedListNode|null
     */
    protected function at(int $index) : ?LinkedListNode
    {
        if ($index < 0)
        {
            return null;
        }

        $i = 0;
        $node = $this->head->next();

        while ($node)
        {
            if ($i == $index)
            {
                return $node;
            }

            $i++;
            $node = $node->next();
        }

        return null;
    }

    /**
     * Get list length.
     *
     * @return int - list length.
     */
    public function length() : int
    {
        return $this->length;
    }

    /**
     * Get first data.
     */
    public function first()
    {
        $firstNode = $this->head->next();
        return ($firstNode) ? $firstNode->getData() : null;
    }

    /**
     * Push data on back of list.
     *
     * @param $data - The data.
     */
    public function pushBack($data) : void
    {
        $node = new LinkedListNode($data);
        $node->linkAfter($this->last);
        $this->last = $node;
        $this->length++;
    }

    /**
     * Push data on back of list.
     *
     * @param $data - The data.
     */
    public function pushFront($data) : void
    {
        $node = new LinkedListNode($data);
        $node->linkAfter($this->head);
        $this->length++;
    }

    /**
     * Iterate through whole linked list.
     *
     * @param $func - function that accepts element of list.
     */
    public function forRange($func) : void
    {
        for ($node = $this->head->next(); $node; $node = $node->next())
        {
            $func($node->getData());
        }
    }

    /**
     * Remove all specific data.
     *
     * @param $data - data to remove.
     */
    public function removeAll($data) : void
    {
        for ($node = $this->head->next();
             $node;
             $node = $node->next())
        {
            if ($node->getData() == $data)
            {
                $toRemove = $node;
                $node = $node->previous();
                $toRemove->linkOut();
                $this->length--;
            }
        }
    }

    /**
     * Sort Linked list.
     *
     * @param $func - function rule to sort.
     */
    public function sort($func) : void
    {
        for ($i = 0; $i < $this->length - 1; $i++)
        {
            for ($j = $i + 1; $j < $this->length; $j++)
            {
                $node1 = $this->at($i);
                $node2 = $this->at($j);

                if ($func($node2->getData(), $node1->getData()))
                {
                    $this->swap($node1, $node2);
                }
            }
        }
    }
}