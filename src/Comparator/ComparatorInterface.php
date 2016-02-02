<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/2/16
 * Time: 10:02 PM
 */

namespace JsonDiff\Comparator;

use JsonDiff\ValueObjects\Json as JsonObject;

interface ComparatorInterface
{
    public function diff(JsonObject $first, JsonObject $second);
}