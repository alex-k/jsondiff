<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/4/16
 * Time: 6:15 PM
 */

namespace JsonDiff\DataProvider\Json;

use JsonDiff\ValueObject\Tree\ImportInterface;

class Import implements ImportInterface
{
    /** @var  array */
    private $data;

    /**
     * Arr constructor.
     * @param String $string
     */
    public function __construct($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException("Can not parse string to json");
        }
        $json = json_decode($string, true);

        if (NULL === $json) {
            throw new \InvalidArgumentException("Can not parse string to json");
        }

        $this->data = json_decode($string, true);
    }

    /**
     * @return array
     */
    public function getDataAsArray()
    {
        return $this->data;
    }

}