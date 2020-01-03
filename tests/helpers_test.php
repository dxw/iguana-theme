<?php

/**
 * @runTestsInSeparateProcesses
 */
class Helpers_Test extends PHPUnit_Framework_TestCase
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

    public function testCallingFunctionViah()
    {
        $helpers = new \Dxw\Iguana\Theme\Helpers();

        \Dxw\Iguana\Registrar::getSingleton()->addInstance(\Dxw\Iguana\Theme\Helpers::class, $helpers);

        $helpers->registerFunction('myFunc', function () {
            return 42;
        });

        $helpers->register();

        $this->assertEquals(42, h()->myFunc());
    }

    public function testCallingFunctionArgumentsViah()
    {
        $helpers = new \Dxw\Iguana\Theme\Helpers();

        \Dxw\Iguana\Registrar::getSingleton()->addInstance(\Dxw\Iguana\Theme\Helpers::class, $helpers);

        $helpers->registerFunction('anotherFunc', function ($a, $b) {
            return 42 + $a + $b;
        });

        $helpers->register();

        $this->assertEquals(48, h()->anotherFunc(1, 5));
    }
}
