<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/2/16
 * Time: 10:00 PM
 */

namespace JsonDiff\Comparator\Diff;

use JsonDiff\DataProvider\Arr;
use JsonDiff\ValueObject\Tree\Tree as TreeObject;

class Tree implements DiffInterface
{
    public function diff(TreeObject $first, TreeObject $second)
    {
        $ret = TreeObject::createFrom(new Arr([]));

        foreach ($second->getKeys() as $key) {

            $value = $second->getKey($key);

            if (!$first->keyExists($key)) {
                $ret->setValue($key, $value);

            } else if ($value instanceof TreeObject) {

                $subTree = $first->getKey($key);
                $this->compareSubTree($subTree, $value, $ret, $key);

            } else if ($first->getKey($key) != $value) {

                $ret->setValue($key, $value);

            }
        }

        return $ret;
    }

    /**
     * @param TreeObject $subTree
     * @param TreeObject $value
     * @param TreeObject $ret
     * @param $key
     */
    private function compareSubTree($subTree, TreeObject $value, &$ret, $key)
    {
        if ($subTree instanceof TreeObject) {
            if ($value->getHash() != $subTree->getHash()) {
                $ret->setValue($key, $this->diff($subTree, $value));
            }
        } else {
            $ret->setValue($key, $value);
        }
    }

}