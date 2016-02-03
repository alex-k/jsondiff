<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/2/16
 * Time: 9:58 PM
 */


chdir(dirname(__DIR__));
require_once("vendor".DIRECTORY_SEPARATOR."autoload.php");


$first = JsonDiff\ValueObjects\Json::fromString('{ "foo":{ "bar":"baz", "biz":"foo" }, "fiz":{ "foo":"baz" }, "bar":"baz", "baz":[ "foo", "bar" ] }');
$second = JsonDiff\ValueObjects\Json::fromString('{ "foo":{ "bar":"baz1", "biz":"foo" }, "fiz":{ "foo":"baz" }, "bar":"baz", "baz":[ "foo1" ] }');

$comparator = new \JsonDiff\Comparator\Json();
$diff = $comparator->diff($first, $second);

echo json_encode($first->toArray()), PHP_EOL;
echo json_encode($second->toArray()), PHP_EOL;
echo json_encode($diff->toArray()), PHP_EOL;

