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

class Json implements DiffTreeInterface
{
    /** @var  DiffTreeInterface */
    private $comparator;

    /**
     * Json constructor.
     * @param DiffTreeInterface $comparator
     */
    public function __construct(DiffTreeInterface $comparator)
    {
        $this->comparator = $comparator;
    }


    public function diff(TreeInterface $first, TreeInterface $second)
    {
        return JsonObject::fromTree($this->comparator->diff($first, $second));
    }
}