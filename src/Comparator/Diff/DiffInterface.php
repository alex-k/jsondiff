<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/3/16
 * Time: 10:22 PM
 */
namespace JsonDiff\Comparator\Diff;

use JsonDiff\ValueObject\Tree\Tree as TreeObject;

interface DiffInterface
{
    /**
     * @param TreeObject $first
     * @param TreeObject $second
     * @return TreeObject
     */
    public function diff(TreeObject $first, TreeObject $second);
}