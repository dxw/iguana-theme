<?php

class Helpers_Test extends \PHPUnit\Framework\TestCase
{
    public function testRegisterFunction()
    {
        $helpers = new \Dxw\Iguana\Theme\Helpers();

        $helpers->registerFunction('myFunc', function () {
            return 42;
        });

        $this->assertEquals(42, $helpers->myFunc());
    }

    public function testFunctionArguments()
    {
        $helpers = new \Dxw\Iguana\Theme\Helpers();

        $helpers->registerFunction('anotherFunc', function ($a, $b) {
            return 42 + $a + $b;
        });

        $this->assertEquals(48, $helpers->anotherFunc(1, 5));
    }

    public function testRegister()
    {
        $helpers = new \Dxw\Iguana\Theme\Helpers();
        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $helpers);

        $this->assertFalse(function_exists('h'));

        $helpers->register();

        $this->assertTrue(function_exists('h'));
    }
}
