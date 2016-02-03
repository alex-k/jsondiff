<?php
namespace src\ValueObjects;

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
        $json = \JsonDiff\ValueObjects\Json::fromString(Array());
    }

    /**
     * @expectedException     \InvalidArgumentException
     */
    public function testWithInvalidJson()
    {
        $json = \JsonDiff\ValueObjects\Json::fromString('[a,b,]');
    }

    public function testGetKeys()
    {
        $json = \JsonDiff\ValueObjects\Json::fromString('{"a":1,"b":2}');

        $this->assertEquals(["a","b"],$json->getKeys());

    }

    public function testGetKey()
    {
        $json = \JsonDiff\ValueObjects\Json::fromString('{"a":1,"b":2}');
        $this->assertEquals(2,$json->getKey("b"));
    }

    /**
     * @expectedException     \OutOfBoundsException
     */
    public function testGetUnexistedKey()
    {
        $json = \JsonDiff\ValueObjects\Json::fromString('{"a":1,"b":2}');
        $json->getKey("c");
    }


    public function testKeyExists()
    {
        $json = \JsonDiff\ValueObjects\Json::fromString('{"b":2}');
        $this->assertTrue($json->keyExists("b"));
        $this->assertFalse($json->keyExists("c"));
    }


    public function testSubTreeCreation()
    {

        $string = '{"a":1,"b":{"c":2},"c":{"c":2}}';
        $json = \JsonDiff\ValueObjects\Json::fromString($string);
        $this->assertTrue($json->keyExists("a"));
        $this->assertTrue($json->keyExists("b"));
        $this->assertTrue($json->keyExists("c"));

        $this->assertTrue($json->getKey("c")->keyExists("c"));
        $this->assertEquals(2, $json->getKey("c")->getKey("c"));
        $this->assertEquals($json->getKey("b")->getHash(), $json->getKey("c")->getHash());

        $this->assertEquals($string,json_encode($json->toArray()));
    }

}
