<?php
namespace JsonDiff\ValueObject;

class TreeTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    public function testGetKeys()
    {
        $tree = Tree::fromArray(["a"=>1,"b"=>2]);

        $this->assertEquals(["a","b"],$tree->getKeys());

    }

    public function testGetKey()
    {
        $tree = Tree::fromArray(["a"=>1,"b"=>2]);
        $this->assertEquals(2,$tree->getKey("b"));
    }

    /**
     * @expectedException     \OutOfBoundsException
     */
    public function testGetUnexistedKey()
    {
        $tree = Tree::fromArray(["a"=>1,"b"=>2]);
        $tree->getKey("c");
    }


    public function testKeyExists()
    {
        $tree = Tree::fromArray(["b"=>2]);
        $this->assertTrue($tree->keyExists("b"));
        $this->assertFalse($tree->keyExists("c"));
    }


    public function testSubTreeCreation()
    {

        $arr = ["a" => 1, "b" => ["c" => 2], "c" => ["c" => 2]];
        $tree = Tree::fromArray($arr);
        $this->assertTrue($tree->keyExists("a"));
        $this->assertTrue($tree->keyExists("b"));
        $this->assertTrue($tree->keyExists("c"));

        $this->assertTrue($tree->getKey("c")->keyExists("c"));
        $this->assertEquals(2, $tree->getKey("c")->getKey("c"));
        $this->assertEquals($tree->getKey("b")->getHash(), $tree->getKey("c")->getHash());

        $this->assertEquals($arr,$tree->toArray());
    }

}
