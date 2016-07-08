<?php

namespace Dxw\Iguana\Theme;

class Helpers
{
    protected $functions;
    static $singleton;

    protected function __construct()
    {
    }

    public function registerFunction($name, $callable)
    {
        $this->functions[$name] = $callable;
    }

    public function __call($name, $args)
    {
        return call_user_func_array($this->functions[$name], $args);
    }

    public static function init()
    {
        require __DIR__.'/h.php';
    }

    public static function getSingleton()
    {
        if (!isset(self::$singleton)) {
            self::$singleton = new self();
        }

        return self::$singleton;
    }
}
