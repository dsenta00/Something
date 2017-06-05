<?php

require_once ('TreeNode.php');

class NTree
{
    /**
     * @var TreeNode - tree root.
     */
    protected $root;

    /**
     * @var TreeNode - current position.
     */
    protected $currentPosition;

    /**
     * NTree constructor.
     */
    function __construct()
    {
        $this->root = new TreeNode(null,"root");
        $this->currentPosition = $this->root;
    }

    /**
     * Print Recursive with indent.
     *
     * @param int $levelIndent - level indent.
     * @param TreeNode $node - The tree node.
     */
    private function printRecursiveWithIndent(int $levelIndent, TreeNode $node)
    {
        for ($i = 0; $i < $levelIndent; $i++)
        {
            echo "\t";
        }

        echo $node->getData() . "\n";

        $node->
        getLeafList()->
        forRange(function (TreeNode $treeNode) use ($levelIndent) {
            $this->printRecursiveWithIndent($levelIndent+1, $treeNode);
        });
    }

    /**
     * Get current position.
     *
     * @return null|TreeNode
     */
    public function getCurrentPosition() : ?TreeNode
    {
        return $this->currentPosition;
    }

    /**
     * Insert new data on current position.
     *
     * @param $data - The data.
     */
    public function insert($data)
    {
        $this->currentPosition->addLeaf($data);
    }

    /**
     * Move current position to.
     *
     * @param $data - The data.
     */
    public function moveCurrentPositionTo($data)
    {
        $newCurrentPosition = null;

        $this->
        currentPosition->
        getLeafList()->
        forRange(function (TreeNode $treeNode) use ($data, &$newCurrentPosition) {
            if ($treeNode->getData() == $data)
            {
                $newCurrentPosition = $treeNode;
            }
        });

        if (!$newCurrentPosition)
        {
            return;
        }

        $this->currentPosition = $newCurrentPosition;
    }

    /**
     * Move back.
     */
    public function moveBack() : void
    {
        if ($this->currentPosition->getParent())
        {
            $this->currentPosition = $this->currentPosition->getParent();
        }
    }

    /**
     * Print whole tree.
     */
    public function printTree()
    {
        echo "\nTree content ->\n";
        $this->printRecursiveWithIndent(0, $this->root);
    }
}