<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/2/16
 * Time: 10:00 PM
 */

namespace JsonDiff\Comparator;

use JsonDiff\DataProvider\Arr;
use JsonDiff\ValueObject\Tree\Tree;

class TreeDiff implements DiffInterface
{
    public function diff(Tree $first, Tree $second)
    {
        $ret = Tree::createFrom(new Arr([]));

        foreach ($second->getKeys() as $key) {

            $value = $second->getKey($key);

            if (!$first->keyExists($key)) {
                $ret->setValue($key, $value);

            } else if ($value instanceof Tree) {

                $subTree = $first->getKey($key);
                $this->compareSubTree($subTree, $value, $ret, $key);

            } else if ($first->getKey($key) != $value) {

                $ret->setValue($key, $value);

            }
        }

        return $ret;
    }

    /**
     * @param Tree $subTree
     * @param Tree $value
     * @param Tree $ret
     * @param $key
     */
    private function compareSubTree($subTree, Tree $value, &$ret, $key)
    {
        if ($subTree instanceof Tree) {
            if ($value->getHash() != $subTree->getHash()) {
                $ret->setValue($key, $this->diff($subTree, $value));
            }
        } else {
            $ret->setValue($key, $value);
        }
    }

}