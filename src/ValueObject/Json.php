<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/2/16
 * Time: 10:01 PM
 */

namespace JsonDiff\ValueObject;


class Json implements TreeInterface
{
    /** @var TreeInterface  */
    private $tree;

    /**
     * Json constructor.
     * @param TreeInterface $tree
     */
    private function __construct(TreeInterface $tree)
    {
        $this->tree = $tree;
    }

    /**
     * @param $string
     * @return Json
     * @throws \InvalidArgumentException
     */
    public static function fromString($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException("Can not parse string to json");
        }
        $json = json_decode($string, true);

        if (NULL === $json) {
            throw new \InvalidArgumentException("Can not parse string to json");
        }

        return self::fromTree(Tree::fromArray($json));
    }

    /**
     * @param TreeInterface $tree
     * @return Json
     */
    public static function fromTree(TreeInterface $tree)
    {
        return new self($tree);
    }


    /**
     * @return string
     */
    public function getHash()
    {
        return $this->tree->getHash();
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function setValue($key, $value)
    {
        return $this->tree->setValue($key,$value);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function keyExists($key)
    {
        return $this->tree->keyExists($key);
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        return $this->tree->getKeys();
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getKey($key)
    {
        return $this->tree->getKey($key);
    }

    /**
     * @return array|null
     */
    public function toArray()
    {
        return $this->tree->toArray();
    }

    public function toString()
    {
        return json_encode($this->toArray());
    }
}