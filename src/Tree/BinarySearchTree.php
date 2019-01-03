<?php
namespace DataStructure\Tree;

class BinarySearchTree
{
    private $root;

    private $result;

    public function __construct(?TreeNode $root)
    {
        $this->root   = $root;
        $this->result = [];
    }

    public function insert(int $data): void
    {
        $node = $this->root;
        $prev = null;

        while ($node) {
            $prev = $node;

            if ($node->getData() > $data) {
                $node = $node->getLeft();
            } else {
                $node = $node->getRight();
            }
        }

        $newNode = new TreeNode($prev, $data);

        if (!$prev) {
            $this->root = $newNode;
        } elseif ($prev->getData() > $data) {
            $prev->setLeft($newNode);
        } else {
            $prev->setRight($newNode);
        }
    }

    public function search(int $data): ?TreeNode
    {
        $node = $this->root;

        while ($node) {
            if ($node->getData() === $data) {
                return $node;
            }

            if ($node->getData() > $data) {
                $node = $node->getLeft();
            } else {
                $node = $node->getRight();
            }
        }

        return null;
    }

    public function inorder(?TreeNode $node): array
    {
        if (!$node) {
            return [];
        }
        \array_merge($this->result, $this->inorder($node->getLeft()));
        $this->result[] = $node->getData();
        \array_merge($this->inorder($node->getRight()));

        return $this->result;
    }

    public function getRoot(): ?TreeNode
    {
        return $this->root;
    }

    public function delete(int $data): void
    {
        $node = $this->search($data);

        if (!$node) {
            return;
        }

        $parent = $node->getParent();
        $left   = $node->getLeft();
        $right  = $node->getRight();

        if ($left && $right) {
            $next       = $this->leftmost($right);
            $nextParent = $next->getParent();
            $nextParent->setLeft(null);
            $next->setLeft($left);
            $next->setRight($right);
        } elseif ($left) {
            $next = $left;
        } elseif ($right) {
            $next = $right;
        } else {
            $next = null;
        }

        if (!$parent) {
            $this->root = $next;
        } elseif ($parent->getLeft() === $node) {
            $parent->setLeft($next);
        } else {
            $parent->setRight($next);
        }
    }

    private function leftmost(TreeNode $node): ?TreeNode
    {
        while ($node->getLeft()) {
            $node = $node->getLeft();
        }

        return $node;
    }
}
