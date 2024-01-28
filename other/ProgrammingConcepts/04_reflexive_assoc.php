<?php
class Node {
    public $value;
    public $children;

    public function __construct($value) {
        $this->value = $value;
        $this->children = [];
    }

    public function addChild($childNode) {
        $this->children[] = $childNode;
    }
}

$node1 = new Node(1);
$node2 = new Node(2);
$node1->addChild($node2);
?>
