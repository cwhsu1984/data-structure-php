<?php
namespace Test\Tree;

use DataStructure\Tree\RedBlackTree;
use DataStructure\Tree\RedBlackTreeNode;
use PHPUnit\Framework\TestCase;

class RedBlackTreeTest extends TestCase
{
    public function testRotateLeft(): void
    {
        $nullNode = new RedBlackTreeNode(null, RedBlackTreeNode::COLOR_BLACK, 0);
        $root     = new RedBlackTreeNode($nullNode, RedBlackTreeNode::COLOR_BLACK, 50);
        $node1    = new RedBlackTreeNode($root, RedBlackTreeNode::COLOR_BLACK, 60);
        $node2    = new RedBlackTreeNode($node1, RedBlackTreeNode::COLOR_BLACK, 70);
        $root->setRight($node1);
        $root->setLeft($nullNode);
        $node1->setRight($node2);
        $node1->setLeft($nullNode);
        $node2->setLeft($nullNode);
        $node2->setRight($nullNode);
        $tree = new RedBlackTree($root);
        $tree->rotateLeft($root);
        $result = $tree->levelorder();
        $this->assertEquals([60, 50, 70], $result);
    }

    public function testRotateRight(): void
    {
        $nullNode = new RedBlackTreeNode(null, RedBlackTreeNode::COLOR_BLACK, 0);
        $root     = new RedBlackTreeNode($nullNode, RedBlackTreeNode::COLOR_BLACK, 50);
        $node1    = new RedBlackTreeNode($root, RedBlackTreeNode::COLOR_BLACK, 40);
        $node2    = new RedBlackTreeNode($node1, RedBlackTreeNode::COLOR_BLACK, 30);
        $root->setLeft($node1);
        $root->setRight($nullNode);
        $node1->setLeft($node2);
        $node1->setRight($nullNode);
        $node2->setLeft($nullNode);
        $node2->setRight($nullNode);
        $tree = new RedBlackTree($root);
        $tree->rotateRight($root);
        $result = $tree->levelorder();
        $this->assertEquals([40, 30, 50], $result);
    }

    public function testInsert(): void
    {
        $tree = new RedBlackTree();
        $tree->insert(50);
        $tree->insert(20);
        $tree->insert(70);
        $tree->insert(10);
        $tree->insert(40);
        $tree->insert(30);
        $tree->insert(60);
        $tree->insert(80);
        $tree->insert(75);
        $tree->insert(25);
        $tree->insert(79);
        $result = $tree->levelorder();
        $this->assertEquals([50, 20, 70, 10, 30, 60, 79, 25, 40, 75, 80], $result);
    }

    public function testInsertNodeColor(): void
    {
        $tree = new RedBlackTree();
        $tree->insert(30);
        $tree->insert(20);
        $tree->insert(40);
        $tree->insert(10);
        $tree->insert(5);
        $root = $tree->getRoot();
        $this->assertEquals(0, $root->getColor());
        $this->assertEquals(0, $root->getLeft()->getColor());
        $this->assertEquals(0, $root->getRight()->getColor());
        $this->assertEquals(1, $root->getLeft()->getLeft()->getColor());
        $this->assertEquals(1, $root->getLeft()->getRight()->getColor());
    }

    public function testDeleteNodeHasOneChild(): void
    {
        $tree = new RedBlackTree();
        $tree->insert(30);
        $tree->insert(20);
        $tree->insert(40);
        $tree->insert(10);
        $tree->delete(20);
        $result = $tree->levelorder();
        $this->assertEquals([30, 10, 40], $result);
    }

    public function testDeleteNodeHasOneChildColor(): void
    {
        $tree = new RedBlackTree();
        $tree->insert(30);
        $tree->insert(20);
        $tree->insert(40);
        $tree->insert(10);
        $tree->delete(20);
        $root = $tree->getRoot();
        $this->assertEquals(0, $root->getColor());
        $this->assertEquals(0, $root->getLeft()->getColor());
        $this->assertEquals(0, $root->getRight()->getColor());
    }

    public function testDeleteNodeHasTwoChildren(): void
    {
        $tree = new RedBlackTree();
        $tree->insert(30);
        $tree->insert(20);
        $tree->insert(40);
        $tree->insert(10);
        $tree->insert(25);
        $tree->delete(20);
        $result = $tree->levelorder();
        $this->assertEquals([30, 25, 40, 10], $result);
    }

    public function testDeleteNodeHasTwoChildrenColor(): void
    {
        $tree = new RedBlackTree();
        $tree->insert(30);
        $tree->insert(20);
        $tree->insert(40);
        $tree->insert(10);
        $tree->insert(25);
        $tree->delete(20);
        $root = $tree->getRoot();
        $this->assertEquals(0, $root->getColor());
        $this->assertEquals(0, $root->getLeft()->getColor());
        $this->assertEquals(0, $root->getRight()->getColor());
        $this->assertEquals(1, $root->getLeft()->getLeft()->getColor());
    }
}
