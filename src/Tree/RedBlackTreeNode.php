<?php
namespace DataStructure\Tree;

class RedBlackTreeNode extends TreeNode
{
    public const COLOR_RED = 1;

    public const COLOR_BLACK = 0;

    private $color;

    public function __construct(?self $parent, int $color, int $data)
    {
        parent::__construct($parent, $data);
        $this->color = $color;
    }

    public function setColor(int $color): void
    {
        $this->color = $color;
    }

    public function getColor(): int
    {
        return $this->color;
    }

    public function isNil(): bool
    {
        return $this->getParent() === null;
    }

    public function isRed(): bool
    {
        return $this->color === self::COLOR_RED;
    }

    public function isBlack(): bool
    {
        return $this->color === self::COLOR_BLACK;
    }

    public function setData(int $data): void
    {
        $this->data = $data;
    }
}
