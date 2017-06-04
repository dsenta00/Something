<?php

require_once ('LinkedListNode.php');
use PHPUnit\Framework\TestCase;

class LinkedListNodeTest extends TestCase
{

    private function checkOrder(LinkedListNode $head, array $array)
    {
        $i = 0;

        for ($node = $head; $node; $node = $node->next())
        {
            $this->assertEquals($array[$i], $node->getData());

            if ($array[$i-1])
            {
                $this->assertEquals($array[$i-1], $node->previous()->getData());
            }

            if ($array[$i+1])
            {
                $this->assertEquals($array[$i+1], $node->next()->getData());
            }

            $i++;
        }
    }

    public function test_basics()
    {
        $head = new LinkedListNode("head");
        $this->checkOrder($head, array("head"));

        $node1 = new LinkedListNode(1);
        $node1->linkAfter($head);
        $this->checkOrder($head, array("head", 1));

        $node2 = new LinkedListNode(2);
        $node2->linkAfter($head);
        $this->checkOrder($head, array("head", 2, 1));

        $node4 = new LinkedListNode(4);
        $node4->linkAfter($node2);
        $this->checkOrder($head, array("head", 2, 4, 1));

        $node4->linkOut();
        $this->checkOrder($head, array("head", 2, 1));

        $node2->linkOut();
        $this->checkOrder($head, array("head", 1));

        $node1->linkOut();
        $this->checkOrder($head, array("head"));
    }
}
