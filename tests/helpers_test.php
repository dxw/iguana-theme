<?php

class Helpers_Test extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        $cls = new ReflectionClass(\Dxw\Iguana\Theme\Helpers::class);

        $property = $cls->getProperty('singleton');
        $property->setAccessible(true);
        $property->setValue(null);
    }

    public function testRegisterFunction()
    {
        $helpers = \Dxw\Iguana\Theme\Helpers::getSingleton();

        $helpers->registerFunction('myFunc', function () {
            return 42;
        });

        $this->assertEquals(42, $helpers->myFunc());
    }

    public function testFunctionArguments()
    {
        $helpers = \Dxw\Iguana\Theme\Helpers::getSingleton();

        $helpers->registerFunction('anotherFunc', function ($a, $b) {
            return 42 + $a + $b;
        });

        $this->assertEquals(48, $helpers->anotherFunc(1, 5));
    }

    public function testInit()
    {
        $this->assertFalse(function_exists('h'));

        \Dxw\Iguana\Theme\Helpers::init();

        $this->assertTrue(function_exists('h'));
    }

    public function testSingleton()
    {
        $helpers1 = \Dxw\Iguana\Theme\Helpers::getSingleton();
        $helpers2 = \Dxw\Iguana\Theme\Helpers::getSingleton();

        $this->assertSame($helpers1, $helpers2);
    }

    public function testInstantiationErrors()
    {
        // TODO: this causes fatal errors in PHP5
        // marked as an incomplete test in the meantime
        $this->markTestIncomplete();

        $this->setExpectedException(\Error::class);

        new \Dxw\Iguana\Theme\Helpers();
    }
}
