<?php
namespace DataStructure\Tree;

class Tree
{
    private $root;

    private $result = [];

    public function __construct(?TreeNode $root)
    {
        $this->root = $root;
    }

    public function getRoot(): TreeNode
    {
        return $this->root;
    }

    public function preorder(?TreeNode $node): array
    {
        if (!$node) {
            return [];
        }
        $this->result[] = $node->getData();
        \array_merge($this->result, $this->preorder($node->getLeft()));
        \array_merge($this->result, $this->preorder($node->getRight()));

        return $this->result;
    }

    public function inorder(?TreeNode $node): array
    {
        if (!$node) {
            return [];
        }
        \array_merge($this->result, $this->inorder($node->getLeft()));
        $this->result[] = $node->getData();
        \array_merge($this->result, $this->inorder($node->getRight()));

        return $this->result;
    }

    public function postorder(?TreeNode $node): array
    {
        if (!$node) {
            return [];
        }
        \array_merge($this->result, $this->postorder($node->getLeft()));
        \array_merge($this->result, $this->postorder($node->getRight()));
        $this->result[] = $node->getData();

        return $this->result;
    }

    public function levelorder(?TreeNode $node): array
    {
        $children[] = $node;

        while ($children) {
            $node = \array_shift($children);

            if (!$node) {
                continue;
            }
            $this->result[] = $node->getData();
            $children[]     = $node->getLeft();
            $children[]     = $node->getRight();
        }

        return $this->result;
    }

    public function leftmost(TreeNode $node): TreeNode
    {
        while ($node->getLeft()) {
            $node = $node->getLeft();
        }

        return $node;
    }

    public function rightmost(TreeNode $node): TreeNode
    {
        while ($node->getRight()) {
            $node = $node->getRight();
        }

        return $node;
    }

    public function inorderSuccessor(TreeNode $node): ?TreeNode
    {
        if ($node->getRight()) {
            return $this->leftmost($node->getRight());
        }
        $parent = $node->getParent();

        while ($parent && $node !== $parent->getLeft()) {
            $node   = $parent;
            $parent = $node->getParent();
        }

        return $parent;
    }

    public function inorderPredecessor(TreeNode $node): ?TreeNode
    {
        if ($node->getLeft()) {
            return $this->rightmost($node->getLeft());
        }
        $parent = $node->getParent();

        while ($parent && $node !== $parent->getRight()) {
            $node   = $parent;
            $parent = $node->getParent();
        }

        return $parent;
    }

    public function inorderByParent(TreeNode $root): array
    {
        $this->result = [];
        $node         = $this->leftmost($root);

        while ($node) {
            $this->result[] = $node->getData();
            $node           = $this->inorderSuccessor($node);
        }

        return $this->result;
    }

    public function inorderReverse(TreeNode $root): array
    {
        $this->result = [];
        $node         = $this->rightmost($root);

        while ($node) {
            $this->result[] = $node->getData();
            $node           = $this->inorderPredecessor($node);
        }

        return $this->result;
    }

    public function levelorderConstruct(string $input): void
    {
        $array  = \explode(' ', $input);
        $queue  = [];
        $parent = null;
        $data   = \array_shift($array);

        if ($data && $data !== 0) {
            $parent     = new TreeNode(null, $data);
            $this->root = $parent;
        }

        while ($array) {
            $data = \array_shift($array);

            if ($data && $data !== 0) {
                $left = new TreeNode($parent, $data);
                $parent->setLeft($left);
                $queue[] = $left;
            }
            $data = \array_shift($array);

            if ($data && $data !== 0) {
                $right   = new TreeNode($parent, $data);
                $queue[] = $right;
                $parent->setRight($right);
            }
            $parent = \array_shift($queue);
        }
    }

    public function levelorderInsert(int $data): void
    {
        $node = $this->root;

        if (!$node) {
            $this->root = new TreeNode(null, $data);

            return;
        }

        $queue[] = $node;

        while ($queue) {
            $node = \array_shift($queue);

            if ($node->getLeft()) {
                $queue[] = $node->getLeft();
            } else {
                $node->setLeft(new TreeNode($node, $data));

                break;
            }

            if ($node->getRight()) {
                $queue[] = $node->getRight();
            } else {
                $node->setRight(new TreeNode($node, $data));

                break;
            }
        }
    }
}
