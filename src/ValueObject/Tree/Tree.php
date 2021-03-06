<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/2/16
 * Time: 10:01 PM
 */

namespace JsonDiff\ValueObject\Tree;



class Tree
{
    private $data;
    private $hash = "";

    /**
     * Json constructor.
     * @param $data
     */
    private function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @param ImportInterface $provider
     * @return Tree
     */
    public static function createFrom(ImportInterface $provider)
    {
        return self::fromArray($provider->getDataAsArray());
    }

    public function exportWith(ExportInterface $exporter)
    {
        return $exporter->exportFromArray($this->toArray());
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }


    /**
     * @param $arr
     * @return Tree
     */
    private static function fromArray($arr)
    {
        $ret=new self([]);

        foreach ($arr as $key => $value) {
            $ret->setValue($key, $value);
        }

        return $ret;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function setValue($key, $value)
    {
        $this->data[$key] = is_array($value) ? self::fromArray($value) : $value;

        $this->reHash();
    }

    /**
     * @param string $key
     * @return bool
     */
    public function keyExists($key)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        return array_keys($this->data);
    }

    /**
     * @param string $key
     * @return mixed
     * @throws \OutOfBoundsException
     */
    public function getKey($key)
    {
        if (!array_key_exists($key, $this->data)) {
            throw new \OutOfBoundsException("Key not found");
        }

        return $this->data[$key];
    }

    /**
     * @return array|null
     */
    private function toArray()
    {
        if (!$this->getKeys()) {
            return null;
        }

        $ret=[];
        foreach ($this->getKeys() as $key) {
            $value =$this->getKey($key);
            if ($value instanceof Tree) {
                $ret[$key] = $value->toArray();
            } else {
                $ret[$key] = $value;
            }
        }

        return $ret;

    }

    private function reHash()
    {
        $hash = "";
        foreach ($this->getKeys() as $key) {
            $hash .= md5($key);
            $value = $this->getKey($key);
            if ($value instanceof Tree) {
                $hash .= $value->getHash();
            } else {
                $hash .= md5(trim($value));
            }
        }
        $this->hash = md5($hash);
    }
}