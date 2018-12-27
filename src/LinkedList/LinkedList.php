<?php
namespace DataStructure\LinkedList;

class LinkedList
{
    private $first;

    public function __toString(): string
    {
        $curr   = $this->first;
        $result = [];

        while ($curr) {
            $result[] = $curr->getData();
            $curr     = $curr->getNext();
        }

        return \implode(',', $result);
    }

    public function pushFront(int $data): void
    {
        $front = new Node($data);
        $front->setNext($this->first);
        $this->first = $front;
    }

    public function pushBack(int $data): void
    {
        $curr = $this->first;
        $last = $curr;

        while ($curr) {
            $last = $curr;
            $curr = $curr->getNext();
        }
        $node = new Node($data);

        if ($last) {
            $last->setNext($node);
        } else {
            $this->first = $node;
        }
    }

    public function delete(int $data): void
    {
        $prev = null;
        $curr = $this->first;
        $next = $this->first->getNext();

        while ($curr) {
            if ($curr->getData() === $data) {
                if ($prev) {
                    $prev->setNext($next);
                } else {
                    $this->first = $next;
                }

                break;
            }
            $prev = $curr;
            $curr = $prev->getNext();
            $next = $curr->getNext();
        }
    }

    public function clear(): void
    {
        $this->first = null;
    }

    public function reverse(): void
    {
        $curr = $this->first;
        $last = null;

        while ($curr) {
            $node = new Node($curr->getData());
            $node->setNext($last);
            $curr = $curr->getNext();
            $last = $node;
        }
        $this->first = $last;
    }
}
