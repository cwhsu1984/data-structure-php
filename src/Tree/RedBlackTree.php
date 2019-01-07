<?php
namespace DataStructure\Tree;

class RedBlackTree
{
    private $root;

    private $nullNode;

    private $result = [];

    public function __construct(?RedBlackTreeNode $root = null)
    {
        $this->root     = new RedBlackTreeNode(null, RedBlackTreeNode::COLOR_BLACK, 0);
        $this->nullNode = $this->root;

        if ($root) {
            $this->root     = $root;
            $this->nullNode = $root->getParent();
        }
    }

    public function rotateLeft(RedBlackTreeNode $node): void
    {
        $newParent = $node->getRight();
        $newRight  = $node->getRight()->getLeft();

        if ($node === $this->root) {
            $this->root = $newParent;
        }

        $node->setRight($newRight);

        if (!$newRight->isNil()) {
            $newRight->setParent($node);
        }
        $newParent->setParent($node->getParent());

        if ($node->getParent()->getLeft() === $node) {
            $node->getParent()->setLeft($newParent);
        } else {
            $node->getParent()->setRight($newParent);
        }
        $node->setParent($newParent);
        $newParent->setLeft($node);
    }

    public function rotateRight(RedBlackTreeNode $node): void
    {
        $newParent = $node->getLeft();
        $newLeft   = $node->getLeft()->getRight();

        if ($node === $this->root) {
            $this->root = $newParent;
        }

        $node->setLeft($newLeft);

        if (!$newLeft->isNil()) {
            $newLeft->setParent($node);
        }
        $newParent->setParent($node->getParent());

        if ($node->getParent()->getLeft() === $node) {
            $node->getParent()->setLeft($newParent);
        } else {
            $node->getParent()->setRight($newParent);
        }
        $node->setParent($newParent);
        $newParent->setRight($node);
    }

    public function levelorder(): array
    {
        $queue[] = $this->root;

        while ($queue) {
            $node           = \array_shift($queue);
            $this->result[] = $node->getData();
            $child          = $node->getLeft();

            if ($child->getParent()) {
                $queue[] = $child;
            }
            $child = $node->getRight();

            if ($child->getParent()) {
                $queue[] = $child;
            }
        }

        return $this->result;
    }

    public function inorder(RedBlackTreeNode $node)
    {
        if (!$node->getParent()) {
            return [];
        }
        \array_merge($this->result, $this->inorder($node->getLeft()));
        $this->result[] = $node->getData();
        \array_merge($this->result, $this->inorder($node->getRight()));

        return $this->result;
    }

    public function getRoot(): RedBlackTreeNode
    {
        return $this->root;
    }

    public function insert(int $data): void
    {
        $node     = $this->root;
        $nullNode = $node;

        if (!$node->isNil()) {
            $nullNode = $node->getParent();
        }

        $prev = $nullNode;

        while (!$node->isNil()) {
            $prev = $node;

            if ($node->getData() > $data) {
                $node = $node->getLeft();
            } else {
                $node = $node->getRight();
            }
        }

        $newNode = new RedBlackTreeNode($prev, RedBlackTreeNode::COLOR_RED, $data);
        $newNode->setLeft($nullNode);
        $newNode->setRight($nullNode);

        if ($prev->isNil()) {
            $this->root = $newNode;
            $newNode->setColor(RedBlackTreeNode::COLOR_BLACK);
        } elseif ($prev->getData() > $data) {
            $prev->setLeft($newNode);
        } else {
            $prev->setRight($newNode);
        }

        $this->insertFixColor($newNode);
    }

    public function delete(int $data): void
    {
        $node = $this->search($data);

        if (!$node) {
            return;
        }

        if ($node->getLeft()->isNil() || $node->getRight()->isNil()) {
            $delete = $node;
        } else {
            $delete = $this->inorderSuccessor($node);
        }

        if (!$delete->getLeft()->isNil()) {
            $child = $delete->getLeft();
        } else {
            $child = $delete->getRight();
        }

        if (!$child->isNil()) {
            $child->setParent($delete->getParent());
        }

        if ($delete->getParent()->isNil()) {
            $this->root = $child;
        } elseif ($delete === $delete->getParent()->getLeft()) {
            $delete->getParent()->setLeft($child);
        } else {
            $delete->getParent()->setRight($child);
        }

        if ($delete !== $node) {
            $node->setData($delete->getData());
        }

        if ($delete->isBlack()) {
            $this->deleteFixColor($child);
        }
    }

    private function insertFixColor(RedBlackTreeNode $node): void
    {
        while ($node->getParent()->isRed()) {
            $parent = $node->getParent();
            $grand  = $parent->getParent();

            if ($parent === $grand->getLeft()) {
                $uncle = $grand->getRight();

                if ($uncle->isRed()) {
                    $parent->setColor(RedBlackTreeNode::COLOR_BLACK);
                    $uncle->setColor(RedBlackTreeNode::COLOR_BLACK);
                    $grand->setColor(RedBlackTreeNode::COLOR_RED);
                    $node = $grand;
                } else {
                    if ($uncle->isBlack() && $node === $parent->getRight()) {
                        $this->rotateLeft($parent);
                        $node = $parent;
                    }
                    $parent = $node->getParent();
                    $grand  = $parent->getParent();
                    $parent->setColor(RedBlackTreeNode::COLOR_BLACK);
                    $grand->setColor(RedBlackTreeNode::COLOR_RED);
                    $this->rotateRight($grand);
                }
            } else {
                $uncle = $grand->getLeft();

                if ($uncle->isRed()) {
                    $parent->setColor(RedBlackTreeNode::COLOR_BLACK);
                    $uncle->setColor(RedBlackTreeNode::COLOR_BLACK);
                    $grand->setColor(RedBlackTreeNode::COLOR_RED);
                    $node = $grand;
                } else {
                    if ($uncle->isBlack() && $node === $parent->getLeft()) {
                        $this->rotateRight($parent);
                        $node = $parent;
                    }
                    $parent = $node->getParent();
                    $grand  = $parent->getParent();
                    $parent->setColor(RedBlackTreeNode::COLOR_BLACK);
                    $grand->setColor(RedBlackTreeNode::COLOR_RED);
                    $this->rotateLeft($grand);
                }
            }
        }

        $this->root->setColor(RedBlackTreeNode::COLOR_BLACK);
    }

    private function search(int $data): ?RedBlackTreeNode
    {
        $node = $this->root;

        while (!$node->isNil()) {
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

    private function leftmost(RedBlackTreeNode $node): RedBlackTreeNode
    {
        $prev = $node;

        while (!$node->isNil()) {
            $prev = $node;
            $node = $node->getLeft();
        }

        return $prev;
    }

    private function inorderSuccessor(RedBlackTreeNode $node): RedBlackTreeNode
    {
        $node = $node->getRight();

        return $this->leftmost($node);
    }

    private function deleteFixColor(RedBlackTreeNode $node): void
    {
        while ($node->isBlack() && $node !== $this->root) {
            if ($node === $node->getParent()->getLeft()) {
                $sibling = $node->getParent()->getRight();

                if ($sibling->isRed()) {
                    $parent = $node->getParent();
                    $parent->setColor(RedBlackTreeNode::COLOR_RED);
                    $sibling->setColor(RedBlackTreeNode::COLOR_BLACK);
                    $this->rotateLeft($parent);
                } elseif ($sibling->isBlack() && $sibling->getRight()->isBlack() && $sibling->getLeft()->isBlack()) {
                    $sibling->setColor(RedBlackTreeNode::COLOR_RED);
                    $node = $node->getParent();
                } else {
                    if ($sibling->isBlack() && $sibling->getRight->isBlack() && $sibling->getLeft()->isRed()) {
                        $sibling->getLeft()->setColor(RedBlackTreeNode::COLOR_BLACK);
                        $sibling->setColor(RedBlackTreeNode::COLOR_RED);
                        $this->rotateRight($sibling);
                    }
                    $parent      = $node->getParent();
                    $parentColor = $parent->getColor();
                    $sibling->setColor($parentColor);
                    $parent->setColor(RedBlackTreeNode::COLOR_BLACK);
                    $sibling->getRight()->setColor(RedBlackTreeNode::COLOR_BLACK);
                    $this->rotateLeft($parent);
                    $node = $this->root;
                }
            } else {
                $sibling = $node->getParent()->getLeft();

                if ($sibling->isRed()) {
                    $parent = $node->getParent();
                    $parent->setColor(RedBlackTreeNode::COLOR_RED);
                    $sibling->setColor(RedBlackTreeNode::COLOR_BLACK);
                    $this->rotateRight($parent);
                } elseif ($sibling->isBlack() && $sibling->getRight()->isBlack() && $sibling->getLeft()->isBlack()) {
                    $sibling->setColor(RedBlackTreeNode::COLOR_RED);
                    $node = $node->getParent();
                } else {
                    if ($sibling->isBlack() && $sibling->getLeft()->isBlack() && $sibling->getRight()->isRed()) {
                        $sibling->getRight()->setColor(RedBlackTreeNode::COLOR_BLACK);
                        $sibling->setColor(RedBlackTreeNode::COLOR_RED);
                        $this->rotateLeft($sibling);
                    }
                    $parent      = $node->getParent();
                    $parentColor = $parent->getColor();
                    $sibling->setColor($parentColor);
                    $parent->setColor(RedBlackTreeNode::COLOR_BLACK);
                    $sibling->getLeft()->setColor(RedBlackTreeNode::COLOR_BLACK);
                    $this->rotateRight($parent);
                    $node = $this->root;
                }
            }
        }
        $node->setColor(RedBlackTreeNode::COLOR_BLACK);
    }
}
