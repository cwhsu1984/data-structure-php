<?php
namespace Test\Queue;

use DataStructure\Queue\Queue;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    public function testPush(): void
    {
        $queue = $this->getQueue();
        $queue->push(10);
        $queue->push(20);
        print $queue;
        $this->expectOutputString('10,20');
    }

    public function testPop(): void
    {
        $queue = $this->getQueue();
        $queue->push(10);
        $result = $queue->pop();
        $this->assertEquals(10, $result);
    }

    public function testPopThrowExceptionOnEmptyQueue(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        $queue  = $this->getQueue();
        $queue->pop();
    }

    public function testFront(): void
    {
        $queue = $this->getQueue();
        $queue->push(10);
        $result = $queue->front();
        $this->assertEquals(10, $result);
    }

    public function testFrontThrowExceptionOnEmptyQueue(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        $queue  = $this->getQueue();
        $queue->front();
    }

    public function testBack(): void
    {
        $queue = $this->getQueue();
        $queue->push(10);
        $result = $queue->back();
        $this->assertEquals(10, $result);
    }

    public function testBackThrowExceptionOnEmptyQueue(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        $queue  = $this->getQueue();
        $queue->back();
    }

    public function testIsEmptyReturnFalse(): void
    {
        $queue = $this->getQueue();
        $queue->push(10);
        $this->assertFalse($queue->isEmpty());
    }

    public function testIsEmptyReturnTrue(): void
    {
        $queue = $this->getQueue();
        $this->assertTrue($queue->isEmpty());
    }

    public function testSize(): void
    {
        $queue = $this->getQueue();
        $queue->push(10);
        $result = $queue->size();
        $this->assertEquals(1, $result);
    }

    private function getQueue(): Queue
    {
        return new Queue();
    }
}
