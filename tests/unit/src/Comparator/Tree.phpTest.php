<?php
namespace JsonDiff\Comparator;


use JsonDiff\DataProvider\Arr;
use JsonDiff\ValueObject\Tree\Tree;

class TreeComparatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  TreeDiff */
    private $comparator;

    protected function setUp()
    {
        $this->comparator = new TreeDiff();

    }

    protected function tearDown()
    {
    }

    public function testAddedString()
    {
        $first = Tree::createFrom(new Arr(["a" => 1, "b" => 2]));
        $second = Tree::createFrom(new Arr(["a" => 1, "b" => 2, "c" => 2]));

        $this->assertEquals(["c" => 2], $this->comparator->diff($first, $second)->toArray());
    }

    public function testChangedString()
    {
        $first = Tree::createFrom(new Arr(["a" => 1, "b" => 2]));
        $second = Tree::createFrom(new Arr(["b" => 3]));

        $this->assertEquals(["b" => 3], $this->comparator->diff($first, $second)->toArray());
    }

    public function testChangedStringInSubTree()
    {
        $first = Tree::createFrom(new Arr(["a" => 1, "b" => ["c" => 2]]));
        $second = Tree::createFrom(new Arr(["a" => 1, "b" => ["c" => 3]]));

        $this->assertEquals(["b" => ["c" => 3]], $this->comparator->diff($first, $second)->toArray());
    }

    public function testChangedObjectInSubTree()
    {
        $first = Tree::createFrom(new Arr(["a" => 1, "b" => ["c" => 2, "d" => 3]]));
        $second = Tree::createFrom(new Arr(["a" => 1, "b" => ["c" => 2, "d" => ["e" => 4]]]));

        $this->assertEquals(["b" => ["d" => ["e" => 4]]], $this->comparator->diff($first, $second)->toArray());
    }


}
