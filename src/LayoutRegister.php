<?php

namespace Dxw\Iguana\Theme;

class LayoutRegister implements \Dxw\Iguana\Registerable
{
    public function __construct(\Dxw\Iguana\Theme\Helpers $helpers)
    {
        $helpers->registerFunction('w_requested_template', [$this, 'wRequestedTemplate']);
    }

    public function register()
    {
        add_filter('template_include', [\Dxw\Iguana\Theme\Layout::class, 'apply'], 99);
    }

    public function wRequestedTemplate()
    {
        require \Dxw\Iguana\Theme\Layout::$wordpress_template;
    }
}
