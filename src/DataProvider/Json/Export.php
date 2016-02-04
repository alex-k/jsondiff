<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/4/16
 * Time: 6:15 PM
 */

namespace JsonDiff\DataProvider\Json;

use JsonDiff\ValueObject\Tree\ExportInterface;

class Export implements ExportInterface
{

    public function __construct()
    {
    }

    /**
     * @param array $arr
     * @return array
     */
    public function exportFromArray($arr)
    {
        return json_encode($arr);
    }
}