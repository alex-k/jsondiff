<?php
namespace JsonDiff\Comparator\Diff;


use JsonDiff\DataProvider\DummyArray\Provider;
use JsonDiff\ValueObject\Tree\Tree as TreeObject;

class TreeComparatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Tree */
    private $comparator;
    
    /** @var  Provider */
    private $exporter;

    protected function setUp()
    {
        $this->comparator = new Tree();
        $this->exporter= new Provider([]);

    }

    protected function tearDown()
    {
    }

    public function testAddedString()
    {
        $first = TreeObject::createFrom(new Provider(["a" => 1, "b" => 2]));
        $second = TreeObject::createFrom(new Provider(["a" => 1, "b" => 2, "c" => 2]));

        $this->assertEquals(["c" => 2], $this->comparator->diff($first, $second)->exportWith($this->exporter));
    }

    public function testChangedString()
    {
        $first = TreeObject::createFrom(new Provider(["a" => 1, "b" => 2]));
        $second = TreeObject::createFrom(new Provider(["b" => 3]));

        $this->assertEquals(["b" => 3], $this->comparator->diff($first, $second)->exportWith($this->exporter));
    }

    public function testChangedStringInSubTree()
    {
        $first = TreeObject::createFrom(new Provider(["a" => 1, "b" => ["c" => 2]]));
        $second = TreeObject::createFrom(new Provider(["a" => 1, "b" => ["c" => 3]]));

        $this->assertEquals(["b" => ["c" => 3]], $this->comparator->diff($first, $second)->exportWith($this->exporter));
    }

    public function testChangedObjectInSubTree()
    {
        $first = TreeObject::createFrom(new Provider(["a" => 1, "b" => ["c" => 2, "d" => 3]]));
        $second = TreeObject::createFrom(new Provider(["a" => 1, "b" => ["c" => 2, "d" => ["e" => 4]]]));

        $this->assertEquals(["b" => ["d" => ["e" => 4]]], $this->comparator->diff($first, $second)->exportWith($this->exporter));
    }


}
