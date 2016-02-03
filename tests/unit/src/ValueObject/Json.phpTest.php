<?php
namespace JsonDiff\ValueObject;


class JsonTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    /**
     * @expectedException     \InvalidArgumentException
     */
    public function testWithNonStringAsArgument()
    {
        $json = Json::fromString(Array());
    }

    /**
     * @expectedException     \InvalidArgumentException
     */
    public function testWithInvalidJson()
    {
        $json = Json::fromString('[a,b,]');
    }

    public function testGetKeys()
    {
        $json = Json::fromString('{"a":1,"b":2}');

        $this->assertEquals(["a", "b"], $json->getKeys());

    }

    public function testGetKey()
    {
        $json = Json::fromString('{"a":1,"b":2}');
        $this->assertEquals(2, $json->getKey("b"));
    }

    /**
     * @expectedException     \OutOfBoundsException
     */
    public function testGetUnexistedKey()
    {
        $json = Json::fromString('{"a":1,"b":2}');
        $json->getKey("c");
    }


    public function testKeyExists()
    {
        $json = Json::fromString('{"b":2}');
        $this->assertTrue($json->keyExists("b"));
        $this->assertFalse($json->keyExists("c"));
    }


    public function testGetHash()
    {
        $json = Json::fromString('{"b":2}');
        $this->assertEquals("5c7f4cae807b5df50033029edcd1c69d", $json->getHash());
    }

    public function testSetValue()
    {
        $json = Json::fromString('{"a":1,"b":2}');
        $json->setValue("c", 4);
        $this->assertEquals(4, $json->getKey("c"));
    }


    public function testSubTreeCreation()
    {

        $string = '{"a":1,"b":{"c":2},"c":{"c":2}}';
        $json = Json::fromString($string);
        $this->assertTrue($json->keyExists("a"));
        $this->assertTrue($json->keyExists("b"));
        $this->assertTrue($json->keyExists("c"));

        $this->assertTrue($json->getKey("c")->keyExists("c"));
        $this->assertEquals(2, $json->getKey("c")->getKey("c"));
        $this->assertEquals($json->getKey("b")->getHash(), $json->getKey("c")->getHash());

        $this->assertEquals(json_decode($string, true), $json->toArray());
        $this->assertEquals($string, $json->toString());
    }

}
