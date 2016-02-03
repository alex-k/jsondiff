<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/2/16
 * Time: 10:00 PM
 */

namespace JsonDiff\Comparator;

use JsonDiff\ValueObject\TreeInterface;
use JsonDiff\ValueObject\Tree as TreeObject;

class TreeDiff implements DiffInterface
{
    public function diff(TreeInterface $first, TreeInterface $second)
    {
        $ret = TreeObject::fromArray([]);

        foreach ($second->getKeys() as $key) {

            $value = $second->getKey($key);

            if (!$first->keyExists($key)) {
                $ret->setValue($key, $value);

            } else if ($value instanceof TreeInterface) {

                $subTree = $first->getKey($key);
                $this->compareSubTree($subTree, $value, $ret, $key);

            } else if ($first->getKey($key) != $value) {

                $ret->setValue($key, $value);

            }
        }

        return $ret;
    }

    /**
     * @param $subTree
     * @param $value
     * @param $ret
     * @param $key
     */
    private function compareSubTree($subTree, $value, &$ret, $key)
    {
        if ($subTree instanceof TreeInterface) {
            if ($value->getHash() != $subTree->getHash()) {
                $ret->setValue($key, $this->diff($subTree, $value));
            }
        } else {
            $ret->setValue($key, $value);
        }
    }

}