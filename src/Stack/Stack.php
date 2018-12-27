<?php
namespace DataStructure\Stack;

class Stack
{
    private $data;

    private $size = 0;

    public function __toString(): string
    {
        return \implode(',', $this->data);
    }

    public function push(int $data): void
    {
        $this->data[] = $data;
        $this->size++;
    }

    public function pop(): int
    {
        $result = $this->top();
        unset($this->data[$this->size - 1]);
        $this->size--;

        return $result;
    }

    public function top(): int
    {
        $this->checkEmpty();

        return $this->data[$this->size - 1];
    }

    public function isEmpty()
    {
        return $this->size() === 0;
    }

    public function size()
    {
        return $this->size;
    }

    private function checkEmpty(): void
    {
        if ($this->isEmpty()) {
            throw new \OutOfBoundsException();
        }
    }
}
