<?php

// This file is intentionally not namespaced

if (!function_exists('h')) {
    function h()
    {
        return \Dxw\Iguana\Theme\Helpers::getSingleton();
    }
}
