<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/3/16
 * Time: 9:25 PM
 */
namespace JsonDiff\ValueObject;

interface TreeInterface
{
    /**
     * @return string
     */
    public function getHash();

    /**
     * @param string $key
     * @param mixed $value
     */
    public function setValue($key, $value);

    /**
     * @param string $key
     * @return bool
     */
    public function keyExists($key);

    /**
     * @return array
     */
    public function getKeys();

    /**
     * @param string $key
     * @return mixed
     */
    public function getKey($key);

    /**
     * @return array|null
     */
    public function toArray();
}