<?php
namespace JsonDiff\ValueObject\Tree;

use JsonDiff\DataProvider\DummyArray\Provider;

class TreeTest extends \PHPUnit_Framework_TestCase
{
    private $exporter;

    protected function setUp()
    {
        $this->exporter = new Provider([]);
    }

    protected function tearDown()
    {
    }

    public function testGetKeys()
    {
        $tree = Tree::createFrom(new Provider(["a" => 1, "b" => 2]));

        $this->assertEquals(["a", "b"], $tree->getKeys());

    }

    public function testGetKey()
    {
        $tree = Tree::createFrom(new Provider(["a" => 1, "b" => 2]));
        $this->assertEquals(2, $tree->getKey("b"));
    }


    /**
     * @expectedException     \OutOfBoundsException
     */
    public function testGetUnexistedKey()
    {
        $tree = Tree::createFrom(new Provider(["a" => 1, "b" => 2]));
        $tree->getKey("c");
    }

    public function testKeyExists()
    {
        $tree = Tree::createFrom(new Provider(["b" => 2]));
        $this->assertTrue($tree->keyExists("b"));
        $this->assertFalse($tree->keyExists("c"));
    }

    public function testGetHash()
    {
        $tree = Tree::createFrom(new Provider(["b" => 2]));
        $this->assertEquals("5c7f4cae807b5df50033029edcd1c69d", $tree->getHash());
    }

    public function testSetValue()
    {
        $tree = Tree::createFrom(new Provider(["b" => 2]));
        $tree->setValue("c", 4);
        $this->assertEquals(4, $tree->getKey("c"));
    }


    public function testToNullArray()
    {
        $tree = Tree::createFrom(new Provider([]));
        $this->assertNull($tree->exportWith($this->exporter));
    }


    public function testSubTreeCreation()
    {
        $arr = ["a" => 1, "b" => ["c" => 2], "c" => ["c" => 2]];
        $tree = Tree::createFrom(new Provider($arr));
        $this->assertTrue($tree->keyExists("a"));
        $this->assertTrue($tree->keyExists("b"));
        $this->assertTrue($tree->keyExists("c"));

        $this->assertTrue($tree->getKey("c")->keyExists("c"));
        $this->assertEquals(2, $tree->getKey("c")->getKey("c"));
        $this->assertEquals($tree->getKey("b")->getHash(), $tree->getKey("c")->getHash());

        $this->assertEquals($arr, $tree->exportWith($this->exporter));
    }

}
