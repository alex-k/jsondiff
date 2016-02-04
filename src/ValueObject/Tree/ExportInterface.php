<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/4/16
 * Time: 5:56 PM
 */

namespace JsonDiff\ValueObject\Tree;


interface ExportInterface
{
    /**
     * @param array $arr
     * @return mixed
     */
    public function exportFromArray($arr);
}