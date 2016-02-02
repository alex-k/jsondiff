<?php
namespace src\Comparator;

class JsonTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    public function testChangedString()
    {
        $first = \JsonDiff\ValueObjects\Json::fromString('{"a":1,"b":2}');
        $second = \JsonDiff\ValueObjects\Json::fromString('{"b":3}');

        $comparator= new \JsonDiff\Comparator\Json();

        $diff = $comparator->diff($first,$second);

        $this->assertEquals('{"b":3}', json_encode($diff->toArray()));

    }
}
