<?php
namespace DataStructure\LinkedList;

class Node
{
    private $data;

    private $next;

    public function __construct(int $data)
    {
        $this->data = $data;
    }

    public function setNext(?self $next): void
    {
        $this->next = $next;
    }

    public function getNext(): ?self
    {
        return $this->next;
    }

    public function getData(): int
    {
        return $this->data;
    }
}
