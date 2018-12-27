<?php
namespace DataStructure\Queue;

class Queue
{
    private $data;

    private $front = 0;

    private $back = 0;

    private $size = 0;

    public function __toString(): string
    {
        return \implode(',', $this->data);
    }

    public function push(int $data): void
    {
        $this->size++;
        $this->back   = $this->size - 1;
        $this->data[] = $data;
    }

    public function pop(): int
    {
        $result = $this->front();
        unset($this->data[$this->front]);
        $this->size--;
        $this->front++;

        return $result;
    }

    public function front(): int
    {
        $this->checkSize();

        return $this->data[$this->front];
    }

    public function back(): int
    {
        $this->checkSize();

        return $this->data[$this->back];
    }

    public function isEmpty(): bool
    {
        return $this->size === 0;
    }

    public function size(): int
    {
        return $this->size;
    }

    private function checkSize(): void
    {
        if ($this->isEmpty()) {
            throw new \OutOfBoundsException();
        }
    }
}
