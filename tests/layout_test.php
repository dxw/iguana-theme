<?php

class Layout_Test extends \PHPUnit\Framework\TestCase
{
    public function setUp() : void
    {
        \WP_Mock::setUp();
    }

    public function tearDown() : void
    {
        \WP_Mock::tearDown();

        \Dxw\Iguana\Theme\Layout::$wordpress_template = null;
        \Dxw\Iguana\Theme\Layout::$base = null;
    }

    public function testApply()
    {
        $this->assertInstanceOf(
            \Dxw\Iguana\Theme\Layout::class,
            \Dxw\Iguana\Theme\Layout::apply('x/y/z.php')
        );

        $this->assertEquals(
            'x/y/z.php',
            \Dxw\Iguana\Theme\Layout::$wordpress_template
        );

        $this->assertEquals(
            'z',
            \Dxw\Iguana\Theme\Layout::$base
        );
    }

    public function testToString()
    {
        $layout = new \Dxw\Iguana\Theme\Layout();
        $layout->slug = 'slug';

        \WP_Mock::onFilter('roots_wrap_slug')
        ->with(['layouts/main.php'])
        ->reply(['layouts/my-layout.php']);

        \WP_Mock::wpFunction('locate_template', [
            'args' => [['layouts/my-layout.php']],
            'return' => 'correct output',
        ]);

        $this->assertEquals(
            'correct output',
            $layout->__toString()
        );
    }

    public function testConstructor()
    {
        $this->markTestIncomplete();
    }
}
