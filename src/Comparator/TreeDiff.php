<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/2/16
 * Time: 10:00 PM
 */

namespace JsonDiff\Comparator;

use JsonDiff\ValueObject\TreeInterface;

class TreeDiff implements DiffInterface
{
    public function diff(TreeInterface $first, TreeInterface $second)
    {
        $ret=\JsonDiff\ValueObject\Tree::fromArray([]);

        foreach ($second->getKeys() as $key) {

            $value=$second->getKey($key);

            if (!$first->keyExists($key)) {
                $ret->setValue($key,$value);
            } else if ($value instanceof TreeInterface) {

                $firstValue=$first->getKey($key);

                if ($firstValue instanceof TreeInterface) {

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