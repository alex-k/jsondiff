<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/3/16
 * Time: 10:23 PM
 */

namespace JsonDiff\Comparator;


use JsonDiff\ValueObject\TreeInterface;
use JsonDiff\ValueObject\Json as JsonObject;

class JsonDiff implements DiffInterface
{
    /** @var  DiffInterface */
    private $comparator;

    /**
     * Json constructor.
     * @param DiffInterface $comparator
     */
    public function __construct(DiffInterface $comparator)
    {
        $this->comparator = $comparator;
    }


    public function diff(TreeInterface $first, TreeInterface $second)
    {
        return JsonObject::fromTree($this->comparator->diff($first, $second));
    }
}