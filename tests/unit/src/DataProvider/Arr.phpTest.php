<?php
namespace JsonDiff\DataProvider;

class ArrTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    public function testArr()
    {
        $data = ["a" => "b"];
        $provider = new Arr($data);
        $this->assertEquals($data, $provider->getDataAsArray());
        $this->assertEquals($data, $provider->exportFromArray($data));
    }
}
