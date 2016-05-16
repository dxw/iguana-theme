# iguana-theme

Helpful gubbins for making themes with Iguana.

## What does this repo provide

### `\Dxw\Iguana\Theme\Helpers`

Your classes can easily declare helper functions:

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

And to call this helper function from a template, simply:

```
<?php h()->myFunc(4) ?>
```

Using `h()` means that you only need to pollute the global namespace with one function. And `h()` is a lot shorter than typing out the full namespace.
