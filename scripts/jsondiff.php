<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/2/16
 * Time: 9:58 PM
 */


chdir(dirname(__DIR__));
require_once("vendor".DIRECTORY_SEPARATOR."autoload.php");


$first = JsonDiff\ValueObjects\Json::fromString(<<<JSON
{
    "foo":{
    "bar":"baz",
"biz":"foo"
},
"fiz":{
    "foo":"baz"
},
"bar":"baz",
"baz":[
    "foo",
    "bar"
]
}
JSON
);


var_dump($first);
