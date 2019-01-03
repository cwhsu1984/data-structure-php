<?php
namespace Test\Tree;

use DataStructure\Tree\BinarySearchTree;
use PHPUnit\Framework\TestCase;

class BinarySearchTreeTest extends TestCase
{
    public function testInsert(): void
    {
        $tree   = $this->createTree();
        $result = $tree->inorder($tree->getRoot());
        $this->assertEquals([1, 6, 8, 15], $result);
    }

    public function testDeleteNodeNoChild(): void
    {
        $tree = $this->createTree();
        $tree->delete(1);
        $result = $tree->inorder($tree->getRoot());
        $this->assertEquals([6, 8, 15], $result);
    }

    public function testDeleteNodeOneChild(): void
    {
        $tree = $this->createTree();
        $tree->delete(15);
        $result = $tree->inorder($tree->getRoot());
        $this->assertEquals([1, 6, 8], $result);
    }

    public function testDeleteNodeTwoChildren(): void
    {
        $tree = $this->createTree();
        $tree->delete(6);
        $result = $tree->inorder($tree->getRoot());
        $this->assertEquals([1, 8, 15], $result);
    }

    public function testSearchFindNode(): void
    {
        $tree = new BinarySearchTree(null);
        $tree->insert(6);
        $tree->insert(1);
        $tree->insert(2);
        $node   = $tree->search(2);
        $result = $node->getData();
        $this->assertEquals(2, $result);
    }

    public function testSearchNotFoundReturnNull(): void
    {
        $tree   = new BinarySearchTree(null);
        $result = $tree->search(8);
        $this->assertNull($result);
    }

    private function createTree()
    {
        $tree = new BinarySearchTree(null);
        $tree->insert(6);
        $tree->insert(1);
        $tree->insert(15);
        $tree->insert(8);

        return $tree;
    }
}
