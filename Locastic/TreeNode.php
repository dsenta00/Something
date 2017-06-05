<?php

require_once('LinkedList.php');

class TreeNode
{
    /**
     * @var The data.
     */
    protected $data;

    /**
     * @var LinkedList
     */
    protected $leafList;

    /**
     * @var TreeNode
     */
    protected $parent;

    /**
     * TreeNode constructor.
     * @param TreeNode $parent - The parent
     * @param $data - The data.
     */
    function __construct($parent = null, $data = null)
    {
        $this->data = $data;
        $this->parent = $parent;
        $this->leafList = new LinkedList();
    }

    /**
     * Add new leaf.
     *
     * @param $data - The data.
     */
    public function addLeaf($data)
    {
        $leaf = new TreeNode($this, $data);
        $this->leafList->pushBack($leaf);
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

    /**
     * Get parent node.
     *
     * @return null|TreeNode
     */
    public function getParent() : ?TreeNode
    {
        return $this->parent;
    }

    /**
     * Get leaf list.
     *
     * @return LinkedList
     */
    public function getLeafList() : LinkedList
    {
        return $this->leafList;
    }
}