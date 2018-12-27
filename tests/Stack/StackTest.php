<?php
namespace Test\Stack;

use DataStructure\Stack\Stack;
use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    public function testPush(): void
    {
        $stack = $this->getStack();
        $stack->push(10);
        $stack->push(20);
        $this->expectOutputString('10,20');
        print $stack;
    }

    public function testPop(): void
    {
        $stack = $this->getStack();
        $stack->push(10);
        $result = $stack->pop();
        $size   = $stack->size();
        $this->assertEquals(10, $result);
        $this->assertEquals(0, $size);
    }

    public function testPopThrowExceptionWhenEmpty(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        $stack  = $this->getStack();
        $result = $stack->pop();
    }

    public function testTop(): void
    {
        $stack = $this->getStack();
        $stack->push(10);
        $result = $stack->top();
        $size   = $stack->size();
        $this->assertEquals(10, $result);
        $this->assertEquals(1, $size);
    }

    public function testTopThrowExceptionWhenEmpty(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        $stack  = $this->getStack();
        $result = $stack->top();
    }

    public function testIsEmptyReturnTrue(): void
    {
        $stack  = $this->getStack();
        $result = $stack->isEmpty();
        $this->assertTrue($result);
    }

    public function testGetSizeReturn2(): void
    {
        $stack = $this->getStack();
        $stack->push(10);
        $stack->push(20);
        $result = $stack->size();
        $this->assertEquals(2, $result);
    }

    private function getStack(): Stack
    {
        return new Stack();
    }
}
