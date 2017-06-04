<?php

require_once('LinkedList.php');
use PHPUnit\Framework\TestCase;

class LinkedListTest extends TestCase
{
    /**
     * Check if list matches array.
     *
     * @param LinkedList $list - The linked list.
     * @param array $array - An array.
     */
    private function checkList(LinkedList $list, array $array) : void
    {
        $i = 0;

        $this->assertEquals($list->length(), count($array));

        $list->forRange(function ($data) use ($array, &$i) {
            $this->assertEquals($array[$i++], $data);
        });
    }

    /**
     * Test basics.
     */
    public function test_basics() : void
    {
        $list = new LinkedList();
        $this->assertEquals(0, $list->length());
        $this->assertEquals(null, $list->first());

        $list->sort(function ($data1, $data2) {
            return $data1 < $data2;
        });

        $this->assertEquals(0, $list->length());
        $this->assertEquals(null, $list->first());
    }

    /**
     * Test LinkedList::pushBack()
     */
    public function test_pushBack() : void
    {
        $list = new LinkedList();

        $list->pushBack(4);
        $this->assertEquals(1, $list->length());
        $this->assertEquals(4, $list->first());

        $list->pushBack(3.0);
        $this->assertEquals(2, $list->length());
        $this->assertEquals(4, $list->first());

        $list->pushBack("Miljenko");
        $this->assertEquals(3, $list->length());
        $this->assertEquals(4, $list->first());

        $this->checkList($list, array(4, 3.0, "Miljenko"));
    }

    /**
     * Test LinkedList::pushFront()
     */
    public function test_pushFront() : void
    {
        $list = new LinkedList();

        $list->pushFront(4);
        $this->assertEquals(1, $list->length());
        $this->assertEquals(4, $list->first());

        $list->pushFront(3.0);
        $this->assertEquals(2, $list->length());
        $this->assertEquals(3.0, $list->first());

        $list->pushFront("Miljenko");
        $this->assertEquals(3, $list->length());
        $this->assertEquals("Miljenko", $list->first());

        $this->checkList($list, array("Miljenko", 3.0, 4));
    }

    /**
     * Test LinkedList::sort()
     */
    public function test_sort() : void
    {
        $list = new LinkedList();

        $list->pushBack(19);
        $list->pushBack(2);
        $list->pushBack(3);
        $list->pushBack(0);

        $this->checkList($list, array(19, 2, 3, 0));

        $list->sort(function (int $data1, int $data2) : bool {
            return $data1 < $data2;
        });

        $this->checkList($list, array(0, 2, 3, 19));
    }
}
