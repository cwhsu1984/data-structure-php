<?php
namespace Test\Set;

use DataStructure\Set\Set;
use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{
    public function testFindSetCollapsing(): void
    {
        $set = $this->getSet();
        $set->findSetCollapsing(5);
        $this->expectOutputString('7,-4,1,1,-1,1,0,-3');
        print $set;
    }

    public function testUnionSet(): void
    {
        $set = $this->getSet();
        $set->unionSet(1, 4);
        $this->expectOutputString('7,-5,1,1,1,3,0,-3');
        print $set;
    }

    private function getSet()
    {
        return new Set([7, -4, 1, 1, -1, 3, 0, -3]);
    }
}
