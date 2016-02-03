<?php
namespace JsonDiff\Comparator;


//use Comparator\Json;
use JsonDiff\ValueObject\Json as JsonObject;

class JsonComparatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Tree */
    private $comparator;

    protected function setUp()
    {
        $this->comparator = new Tree();

    }

    protected function tearDown()
    {
    }

    public function testAddedString()
    {
        $first = JsonObject::fromString('{"a":1,"b":2}');
        $second = JsonObject::fromString('{"a":1,"b":2,"c":2}');

        $this->assertEquals('{"c":2}', json_encode($this->comparator->diff($first, $second)->toArray()));
    }

    public function testChangedString()
    {
        $first = JsonObject::fromString('{"a":1,"b":2}');
        $second = JsonObject::fromString('{"b":3}');

        $this->assertEquals('{"b":3}', json_encode($this->comparator->diff($first, $second)->toArray()));
    }

    public function testChangedStringInSubTree()
    {
        $first = JsonObject::fromString('{"a":1,"b":{"c":2}}');
        $second = JsonObject::fromString('{"a":1,"b":{"c":3}}');

        $this->assertEquals('{"b":{"c":3}}', json_encode($this->comparator->diff($first, $second)->toArray()));
    }

    public function testChangedObjectInSubTree()
    {
        $first = JsonObject::fromString('{"a":1,"b":{"c":2,"d":3}}');
        $second = JsonObject::fromString('{"a":1,"b":{"c":2,"d":{"e":4}}}');

        $this->assertEquals('{"b":{"d":{"e":4}}}', json_encode($this->comparator->diff($first, $second)->toArray()));
    }

    public function testReference()
    {
        $first = JsonObject::fromString('{ "foo":{ "bar":"baz", "biz":"foo" }, "fiz":{ "foo":"baz" }, "bar":"baz", "baz":[ "foo", "bar" ] }');
        $second = JsonObject::fromString('{ "foo":{ "bar":"baz1", "biz":"foo" }, "fiz":{ "foo":"baz" }, "bar":"baz", "baz":[ "foo1" ] }');

        $diff = $this->comparator->diff($first, $second);

        $this->assertEquals('{"foo":{"bar":"baz1"},"baz":["foo1"]}', json_encode($diff->toArray()));
    }


}
