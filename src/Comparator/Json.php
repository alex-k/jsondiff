<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/2/16
 * Time: 10:00 PM
 */

namespace JsonDiff\Comparator;

use JsonDiff\ValueObjects\Json as JsonObject;

class Json implements ComparatorInterface
{
    /**
     * @param JsonObject $first
     * @param JsonObject $second
     * @return JsonObject
     */
    public function diff(JsonObject $first, JsonObject $second)
    {
        $ret=JsonObject::fromString("{}");

        foreach ($second->getKeys() as $key) {
            $value=$second->getKey($key);
            if (!$first->keyExists($key)) {
                $ret->setValue($key,$value);
            } else if ($value instanceof JsonObject) {
                $firstValue=$first->getKey($key);
                if ($firstValue instanceof JsonObject) {
                    if($value->getHash() != $firstValue->getHash()) {
                        $ret->setValue($key,$this->diff($firstValue,$value));
                    }
                } else {
                    $ret->setValue($key,$value);
                }
            } else if ($first->getKey($key) != $value) {
                $ret->setValue($key,$value);
            }
        }

        return $ret;
    }

}