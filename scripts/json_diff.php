<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/2/16
 * Time: 9:58 PM
 */


chdir(dirname(__DIR__));
require_once("vendor".DIRECTORY_SEPARATOR."autoload.php");

use JsonDiff\ValueObject\Tree\Tree as TreeObject;
use JsonDiff\DataProvider\Json\Import as JsonProvider;
use JsonDiff\Comparator\Diff\Tree\Tree as Comparator;
use JsonDiff\DataProvider\Json\Export as JsonExporter;


$first = TreeObject::createFrom(new JsonProvider('{ "foo":{ "bar":"baz", "biz":"foo" }, "fiz":{ "foo":"baz" }, "bar":"baz", "baz":[ "foo", "bar" ] }'));
$second = TreeObject::createFrom(new JsonProvider('{ "foo":{ "bar":"baz1", "biz":"foo" }, "fiz":{ "foo":"baz" }, "bar":"baz", "baz":[ "foo1" ] }'));

$comparator = new Comparator();
$diff = $comparator->diff($first, $second);

$jsonExporter = new JsonExporter();

echo $first->exportWith($jsonExporter), PHP_EOL;
echo $second->exportWith($jsonExporter), PHP_EOL;
echo $diff->exportWith($jsonExporter), PHP_EOL;

