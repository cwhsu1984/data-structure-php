<?php
namespace Test\LinkedList;

use DataStructure\LinkedList\LinkedList;
use PHPUnit\Framework\TestCase;

class LinkedListTest extends TestCase
{
    public function testPushFront(): void
    {
        $list = new LinkedList();
        $list->pushFront(10);
        $list->pushFront(20);
        $this->expectOutputString('20,10');
        print $list;
    }

    public function testPushBack(): void
    {
        $list = new LinkedList();
        $list->pushBack(10);
        $list->pushBack(20);
        $this->expectOutputString('10,20');
        print $list;
    }

    public function testDelete(): void
    {
        $list = new LinkedList();
        $list->pushBack(10);
        $list->delete(10);
        $this->expectOutputString('');
        print $list;
    }

    public function testClear(): void
    {
        $list = new LinkedList();
        $list->pushBack(10);
        $list->clear();
        $this->expectOutputString('');
        print $list;
    }

    public function testReverse(): void
    {
        $list = new LinkedList();
        $list->pushBack(10);
        $list->pushBack(20);
        $list->reverse();
        $this->expectOutputString('20,10');
        print $list;
    }
}
