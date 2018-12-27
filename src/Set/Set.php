<?php
namespace DataStructure\Set;

class Set
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function __toString(): string
    {
        return \implode(',', $this->data);
    }

    public function findSetCollapsing(int $element)
    {
        $root = $element;

        while ($this->data[$root] > 0) {
            $root = $this->data[$root];
        }
        $this->data[$element] = $root;

        return $root;
    }

    public function unionSet(int $x, int $y): void
    {
        if ($this->findDepth($x) > $this->findDepth($y)) {
            $this->data[$x] += $this->data[$y];
            $this->data[$y] = $x;
        } else {
            $this->data[$y] += $this->data[$x];
            $this->data[$x] = $y;
        }
    }

    private function findDepth(int $root): int
    {
        $depth          = 0;
        $next[$depth][] = $root;
        $roots          = $next[$depth];

        while (!empty($roots)) {
            for ($i = 0; $i < \count($this->data); $i++) {
                if (\in_array($this->data[$i], $roots)) {
                    $next[$depth + 1][] = $i;
                }
            }
            $depth++;
            $roots = [];

            if (isset($next[$depth])) {
                $roots = $next[$depth];
            }
        }

        return $depth;
    }
}
