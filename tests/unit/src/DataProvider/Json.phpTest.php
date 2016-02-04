<?php
namespace JsonDiff\DataProvider\Json;

class JsonTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    public function testImport()
    {
        $jsonString = '{"a":"b"}';
        $provider = new Import($jsonString);

        $this->assertEquals(["a"=>"b"], $provider->getDataAsArray());
    }

    public function testExport()
    {

        $exporter = new Export();

        $this->assertEquals('{"a":"b"}', $exporter->exportFromArray(["a"=>"b"]));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidArgument()
    {
        new Import([]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidJson()
    {
        new Import('{"a":"b" "c":"d"}');
    }
}
