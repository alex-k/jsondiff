<?php
namespace JsonDiff\Comparator;


use JsonDiff\ValueObject\Json as JsonObject;

class JsonComparatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Tree */
    private $comparator;

    protected function setUp()
    {
        $this->comparator = new Json(new Tree());

    }

    protected function tearDown()
    {
    }


    public function testReferenceJsons()
    {
        $first = JsonObject::fromString('{ "foo":{ "bar":"baz", "biz":"foo" }, "fiz":{ "foo":"baz" }, "bar":"baz", "baz":[ "foo", "bar" ] }');
        $second = JsonObject::fromString('{ "foo":{ "bar":"baz1", "biz":"foo" }, "fiz":{ "foo":"baz" }, "bar":"baz", "baz":[ "foo1" ] }');

        $diff = $this->comparator->diff($first, $second);

        $this->assertEquals('{"foo":{"bar":"baz1"},"baz":["foo1"]}', $diff->toString());
    }


}
