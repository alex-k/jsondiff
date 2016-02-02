<?php
/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 2/2/16
 * Time: 10:01 PM
 */

namespace JsonDiff\ValueObjects;


class Json
{
    private $json;
    private $hash = "";

    /**
     * Json constructor.
     * @param $json
     */
    private function __construct($json)
    {
        $this->json = $json;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }


    public static function fromString($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException("Can not parse string to json");
        }
        $json = json_decode($string, true);

        if (NULL === $json) {
            throw new \InvalidArgumentException("Can not parse string to json");
        }

        return self::fromArray($json);
    }

    private static function fromArray($arr)
    {
        $ret=new self([]);

        foreach ($arr as $key => $value) {
            $ret->setValue($key, $value);
        }

        return $ret;
    }

    public function getKeys()
    {
        return array_keys($this->json);
    }


    public function keyExists($key)
    {
        return array_key_exists($key, $this->json);
    }

    public function getKey($key)
    {
        if (!array_key_exists($key, $this->json)) {
            throw new \OutOfBoundsException("Key not found");
        }

        return $this->json[$key];
    }


    public function setValue($key, $value)
    {
        $this->json[$key] = $value;

        $hash = "";
        foreach ($this->getKeys() as $key) {
            $hash.=md5($key);
            $value = $this->getKey($key);
            if ($value instanceof Json) {
                $hash .= $value->getHash();
            } else {
                $hash .= md5(trim($value));
            }
        }
        $this->hash=md5($hash);
    }

    public function toArray()
    {
        if (!$this->getKeys()) {
            return null;
        }

        $ret=[];
        foreach ($this->getKeys() as $key) {
            $value =$this->getKey($key);
            if ($value instanceof Json) {
                $ret[$key] = $value->toArray();
            } else {
                $ret[$key] = $value;
            }
        }

        return $ret;

    }
}