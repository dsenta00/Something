<?php

require_once('../../Library/NTree.php');

$tree = new NTree();
$tree->insert("ProgramFiles");
$tree->insert("User");
$tree->moveCurrentPositionTo("User");
$tree->insert("Duje");
$tree->moveBack();
$tree->insert("Zeko Ćup");
$tree->printTree();