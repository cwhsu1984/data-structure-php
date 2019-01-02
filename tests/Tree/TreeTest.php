<?php
namespace Test\Tree;

use DataStructure\Tree\Tree;
use DataStructure\Tree\TreeNode;
use PHPUnit\Framework\TestCase;

class TreeTest extends TestCase
{
    public function testPreorder(): void
    {
        $tree   = $this->createTree();
        $result = $tree->preorder($tree->getRoot());
        $this->assertEquals([1, 2, 4, 5, 3, 6, 7], $result);
    }

    public function testInorder(): void
    {
        $tree   = $this->createTree();
        $result = $tree->inorder($tree->getRoot());
        $this->assertEquals([4, 2, 5, 1, 6, 3, 7], $result);
    }

    public function testPostorder(): void
    {
        $tree   = $this->createTree();
        $result = $tree->postorder($tree->getRoot());
        $this->assertEquals([4, 5, 2, 6, 7, 3, 1], $result);
    }

    public function testLevelorder(): void
    {
        $tree   = $this->createTree();
        $result = $tree->levelorder($tree->getRoot());
        $this->assertEquals([1, 2, 3, 4, 5, 6, 7], $result);
    }

    public function testLeftmost(): void
    {
        $tree   = $this->createTree();
        $left   = $tree->leftmost($tree->getRoot());
        $result = $left->getData();
        $this->assertEquals(4, $result);
    }

    public function testInorderSuccessor(): void
    {
        $tree      = $this->createTree();
        $root      = $tree->getRoot();
        $left      = $root->getLeft();
        $node      = $left->getRight();
        $successor = $tree->inorderSuccessor($node);
        $result    = $successor->getData();
        $this->assertEquals(1, $result);
    }

    public function testInorderPredecessor(): void
    {
        $tree      = $this->createTree();
        $root      = $tree->getRoot();
        $left      = $root->getLeft();
        $node      = $left->getRight();
        $successor = $tree->inorderPredecessor($node);
        $result    = $successor->getData();
        $this->assertEquals(2, $result);
    }

    public function testInorderByParent(): void
    {
        $tree   = $this->createTree();
        $root   = $tree->getRoot();
        $result = $tree->inorderByParent($root);
        $this->assertEquals([4, 2, 5, 1, 6, 3, 7], $result);
    }

    public function testInorderReverse(): void
    {
        $tree   = $this->createTree();
        $root   = $tree->getRoot();
        $result = $tree->inorderReverse($root);
        $this->assertEquals([7, 3, 6, 1, 5, 2, 4], $result);
    }

    public function testLevelorderConstruct(): void
    {
        $tree   = $this->createTreeLevelorder();
        $result = $tree->inorder($tree->getRoot());
        $this->assertEquals([4, 2, 10, 5, 11, 1, 6, 13, 3, 7], $result);
    }

    public function testLevelorderInsert(): void
    {
        $tree = $this->createTreeLevelorder();
        $tree->levelorderInsert(8);
        $tree->levelorderInsert(9);
        $tree->levelorderInsert(12);
        $result = $tree->inorder($tree->getRoot());
        $this->assertEquals([8, 4, 9, 2, 10, 5, 11, 1, 12, 6, 13, 3, 7], $result);
    }

    public function testLevelorderInsertCreateCompleteBinaryTree(): void
    {
        $tree = new Tree(null);
        $tree->levelorderInsert(1);
        $tree->levelorderInsert(2);
        $tree->levelorderInsert(3);
        $tree->levelorderInsert(4);
        $tree->levelorderInsert(5);
        $tree->levelorderInsert(6);
        $result = $tree->inorder($tree->getRoot());
        $this->assertEquals([4, 2, 5, 1, 6, 3], $result);
    }

    private function createTreeLevelorder(): Tree
    {
        $tree = new Tree(null);
        $tree->levelorderConstruct('1 2 3 4 5 6 7 0 0 10 11 0 13');

        return $tree;
    }

    private function createTree(): Tree
    {
        $root  = new TreeNode(null, 1);
        $left  = new TreeNode($root, 2);
        $right = new TreeNode($root, 3);
        $root->setLeft($left);
        $root->setRight($right);
        $node1 = new TreeNode($left, 4);
        $node2 = new TreeNode($left, 5);
        $left->setLeft($node1);
        $left->setRight($node2);
        $node3 = new TreeNode($right, 6);
        $node4 = new TreeNode($right, 7);
        $right->setLeft($node3);
        $right->setRight($node4);

        return new Tree($root);
    }
}
