<?php
namespace JsonDiff\Comparator\Diff\Tree;


use JsonDiff\DataProvider\Json\Export as JsonExport;
use JsonDiff\DataProvider\Json\Import as JsonImport;
use JsonDiff\ValueObject\Tree\Tree as TreeObject;

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

    public function testReferenceJsons()
    {
        $first = TreeObject::createFrom(new JsonImport('{ "foo":{ "bar":"baz", "biz":"foo" }, "fiz":{ "foo":"baz" }, "bar":"baz", "baz":[ "foo", "bar" ] }'));
        $second = TreeObject::createFrom(new JsonImport('{ "foo":{ "bar":"baz1", "biz":"foo" }, "fiz":{ "foo":"baz" }, "bar":"baz", "baz":[ "foo1" ] }'));


        $diff = $this->comparator->diff($first, $second);

        $this->assertEquals('{"foo":{"bar":"baz1"},"baz":["foo1"]}', $diff->exportWith(new JsonExport()));
    }


}
