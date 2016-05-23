# iguana-theme

Helper functions and template layouts for [iguana](https://github.com/dxw/iguana)-based themes.

## `\Dxw\Iguana\Theme\Helpers`

Helper functions.

### Installation

Add the following to `app/di.php`:

```
$registrar->addInstance(\Dxw\Iguana\Theme\Helpers::class, new \Dxw\Iguana\Theme\Helpers());
```

### Usage

Your classes can declare helper functions:

```
<?php

namespace Dxw\MyTheme;

class MyClass
{
    public function __construct(\Dxw\Iguana\Theme\Helpers $helpers)
    {
        $helpers->registerFunction('myFunc', [$this, 'myFunc']);
    }

    public function myFunc($a)
    {
        echo esc_html($a + 1);
    }
}
```

To call this function from a template:

```
<?php h()->myFunc(4) ?>
```

Using `h()` means that you only need to pollute the global namespace with one function. And `h()` is a lot shorter than typing out the full namespace.

All you need to do is pass the `Helpers` instance to your class during instantiation. Example:

```
$registrar->addInstance(\Dxw\MyTheme\MyClass::class, new \Dxw\MyTheme\MyClass(
    $registrar->getInstance(\Dxw\Iguana\Theme\Helpers::class)
));
```

## `\Dxw\Iguana\Theme\Layout` and `\Dxw\Iguana\Theme\LayoutRegister`

Layout templates.

### Installation

Add the following to `app/di.php`:

```
$registrar->addInstance(\Dxw\Iguana\Theme\Helpers::class, new \Dxw\Iguana\Theme\Helpers());
$registrar->addInstance(\Dxw\Iguana\Theme\LayoutRegister::class, new \Dxw\Iguana\Theme\LayoutRegister(
    $registrar->getInstance(\Dxw\Iguana\Theme\Helpers::class)
));
```

### Usage

Add something like this to `layouts/main.php` (within your theme directory):

```
<!doctype html>
<html>
  <head>
    ...
  </head>
  <body>
    <?php h()->w_requested_template() ?>
  </body>
</html>
```

And remove the calls to `get_header()`/`get_footer()` from all your templates.

## Licence

[MIT](COPYING.md)
