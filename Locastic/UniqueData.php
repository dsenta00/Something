<?php

require_once('LinkedListNode.php');

/**
 * Class UniqueData
 */
class UniqueData
{
    /**
     * @var - data.
     */
    private $data;

    /**
     * @var int - number of repetition.
     */
    protected $counter = 1;

    /**
     * UniqueData constructor.
     * @param $data - The data.
     */
    function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get data.
     * @return mixed - The data.
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get first data.
     */
    public function first()
    {
        $firstNode = $this->head->next();
        return ($firstNode) ? $firstNode->getData()->getData() : null;
    }

    /**
     * Get counter.
     *
     * @return int - counter of data repetition.
     */
    public function getCounter() : int
    {
        return $this->counter;
    }

    /**
     * Increase repetition counter.
     */
    public function increase() : void
    {
        $this->counter++;
    }
}