<?php

namespace Dxw\Iguana\Theme;

class Helpers implements \Dxw\Iguana\Registerable
{
    protected $functions;

    public function registerFunction($name, $callable)
    {
        $this->functions[$name] = $callable;
    }

    public function __call($name, $args)
    {
        return call_user_func_array($this->functions[$name], $args);
    }

    public function register()
    {
        require __DIR__.'/h.php';
    }
}
