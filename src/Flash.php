<?php

namespace Booby;

class Flash
{
    private $msg;
    private $options;
    private $index;

    private static $store = [];

    public function __construct($msg, array $options = [])
    {
        $this->msg = $msg;
        $this->options = $options;
        if (!isset($_SESSION['Booby']) || !$_SESSION['Booby']) {
            $_SESSION['Booby'] =& self::$store;
        }
        $this->index = spl_object_hash($this);
    }

    public function __get($name)
    {
        if (isset($this->options[$name])) {
            return $this->options[$name];
        }
        return null;
    }

    public function __isset($name)
    {
        return isset($this->options[$name]);
    }

    public function __toString()
    {
        unset(self::$store[$this->index]);
        return $this->msg;
    }

    public static function me($msg, array $options = [])
    {
        $msg = new Flash($msg, $options);
        self::$store[spl_object_hash($msg)] = $msg;
        return $msg;
    }

    public static function each()
    {
        foreach (self::$store as $msg) {
            yield $msg;
        }
    }

    public static function all()
    {
        return self::$store;
    }
}

