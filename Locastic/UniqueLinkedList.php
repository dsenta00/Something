<?php

require_once('LinkedList.php');
require_once('UniqueData.php');

/**
 * Class UniqueLinkedList.
 * Linked list that contains non repeatable data.
 */
class UniqueLinkedList extends LinkedList
{
    /**
     * Get unique data.
     *
     * @param $data - The data.
     *
     * @return null|UniqueData - unique data if exist, otherwise return null.
     */
    private function getUniqueData($data) : ?UniqueData
    {
        for ($node = $this->head->next();
             $node;
             $node = $node->next())
        {
            if ($node->getData()->getData() == $data)
            {
                return $node->getData();
            }
        }

        return null;
    }

    /**
     * Add unique data if exist, otherwise increase counter.
     *
     * @param $data - The data.
     */
    public function add($data) : void
    {
        $uniqueData = $this->getUniqueData($data);

        if ($uniqueData)
        {
            $uniqueData->increase();
        }
        else
        {
            $uniqueData = new UniqueData($data);
            $this->pushBack($uniqueData);
        }
    }

    /**
     * Get most frequent data.
     *
     * @return mixed - most frequent data if exist, otherwise return null.
     */
    public function getMostFrequentData()
    {
        if ($this->length == 0)
        {
            return null;
        }

        $mostFrequentData = $this->head->next();

        for ($node = $mostFrequentData->next();
             $node;
             $node = $node->next())
        {
            if ($node->getData()->getCounter() > $mostFrequentData->getData()->getCounter())
            {
                $mostFrequentData = $node;
            }
        }

        return $mostFrequentData->getData();
    }

    /**
     * Iterate through whole UniqueLinkedList.
     * This overrides parent::forRange defined in LinkedList.
     *
     * @param $func - function that accepts element of list.
     */
    public function forRange($func) : void
    {
        for ($node = $this->head->next();
             $node;
             $node = $node->next())
        {
            $func($node->getData());
        }
    }
    /**
     * Sort UniqueLinkedList.
     * This overrides parent::sort defined in LinkedList.
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

                if ($func($node2->getData(),
                          $node1->getData()))
                {
                    $this->swap($node1, $node2);
                }
            }
        }
    }
}