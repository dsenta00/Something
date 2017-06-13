<?php

require_once ('../Library/UniqueLinkedList.php');
use PHPUnit\Framework\TestCase;

class UniqueLinkedListTest extends TestCase
{
    /**
     * Check if list matches array.
     *
     * @param UniqueLinkedList $list - The linked list.
     * @param array $array - An array.
     */
    private function checkList(UniqueLinkedList $list, array $array) : void
    {
        $i = 0;
        $this->assertEquals($list->length(), count($array));
        $list->forRange(function (int $data) use ($array, &$i) {
            $this->assertEquals($array[$i++], $data);
        });
    }

    /**
     * Test basics.
     */
    public function test_basics() : void
    {
        $list = new UniqueLinkedList();
        $this->assertEquals(0, $list->length());
        $this->assertEquals(null, $list->first());

        $list->sort(function ($data1, $data2) {
            return $data1 < $data2;
        });

        $this->assertEquals(0, $list->length());
        $this->assertEquals(null, $list->first());
    }

    public function test_add() : void
    {
        $list = new UniqueLinkedList();

        $list->add(19);
        $list->add(2);
        $list->add(3);
        $list->add(3);
        $list->add(0);
        //$list->add(2.0);

        $this->checkList($list, array(19, 2, 3, 0));
    }

    /**
     * Test UniqueLinkedList::sort()
     */
    public function test_sort() : void
    {
        $list = new UniqueLinkedList();

        $list->add(19);
        $list->add(2);
        $list->add(3);
        $list->add(3);
        $list->add(0);

        $this->checkList($list, array(19, 2, 3, 0));

        $list->sort(function (int $data1, int $data2) : bool {
            return $data1 < $data2;
        });

        $this->checkList($list, array(0, 2, 3, 19));
    }
}
