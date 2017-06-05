<?php
/**
 * Created by PhpStorm.
 * User: edujsen
 * Date: 5.6.2017.
 * Time: 15:45
 */

require_once ('NTree.php');
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
