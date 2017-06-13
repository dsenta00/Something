<?php

require_once('../Library/NTree.php');
use PHPUnit\Framework\TestCase;

class NTreeTest extends TestCase
{
    /**
     * Test tree.
     */
    public function test_tree() : void
    {
        $tree = new NTree();
        $this->assertEquals("root", $tree->getCurrentPosition()->getData());

        $tree->moveCurrentPositionTo("User");
        $this->assertEquals("root", $tree->getCurrentPosition()->getData());

        $tree->moveBack();
        $this->assertEquals("root", $tree->getCurrentPosition()->getData());

        $tree->insert("ProgramFiles");
        $tree->insert("User");
        $tree->moveCurrentPositionTo("User");
        $this->assertEquals("User", $tree->getCurrentPosition()->getData());

        $tree->insert("Duje");
        $tree->moveBack();
        $this->assertEquals("root", $tree->getCurrentPosition()->getData());
        $tree->moveBack();
        $this->assertEquals("root", $tree->getCurrentPosition()->getData());
    }


}
