<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/4/16
 * Time: 6:15 PM
 */

namespace JsonDiff\DataProvider;

use JsonDiff\ValueObject\Tree\ExportInterface;
use JsonDiff\ValueObject\Tree\ImportInterface;

class Arr implements ImportInterface, ExportInterface
{
    /** @var  array */
    private $data;

    /**
     * Arr constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getDataAsArray()
    {
        return $this->data;
    }

    /**
     * @param array $arr
     * @return array
     */
    public function exportFromArray($arr)
    {
        return $arr;
    }
}