<?php
namespace JsonDiff\Comparator;


use JsonDiff\ValueObject\Tree as TreeObject;

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
        $first = TreeObject::fromArray(["a" => 1, "b" => 2]);
        $second = TreeObject::fromArray(["a" => 1, "b" => 2, "c" => 2]);

        $this->assertEquals(["c" => 2], $this->comparator->diff($first, $second)->toArray());
    }

    public function testChangedString()
    {
        $first = TreeObject::fromArray(["a" => 1, "b" => 2]);
        $second = TreeObject::fromArray(["b" => 3]);

        $this->assertEquals(["b" => 3], $this->comparator->diff($first, $second)->toArray());
    }

    public function testChangedStringInSubTree()
    {
        $first = TreeObject::fromArray(["a" => 1, "b" => ["c" => 2]]);
        $second = TreeObject::fromArray(["a" => 1, "b" => ["c" => 3]]);

        $this->assertEquals(["b" => ["c" => 3]], $this->comparator->diff($first, $second)->toArray());
    }

    public function testChangedObjectInSubTree()
    {
        $first = TreeObject::fromArray(["a" => 1, "b" => ["c" => 2, "d" => 3]]);
        $second = TreeObject::fromArray(["a" => 1, "b" => ["c" => 2, "d" => ["e" => 4]]]);

        $this->assertEquals(["b" => ["d" => ["e" => 4]]], $this->comparator->diff($first, $second)->toArray());
    }


}
