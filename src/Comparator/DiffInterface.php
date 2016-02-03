<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/3/16
 * Time: 10:22 PM
 */
namespace JsonDiff\Comparator;

use JsonDiff\ValueObject\TreeInterface;

interface DiffInterface
{
    public function diff(TreeInterface $first, TreeInterface $second);
}