<?php

class LayoutRegister_Test extends \PHPUnit\Framework\TestCase
{
    use \Dxw\Iguana\Theme\Testing;

    public function setUp() : void
    {
        \WP_Mock::setUp();
    }

    public function tearDown() : void
    {
        \WP_Mock::tearDown();

        \Dxw\Iguana\Theme\Layout::$wordpress_template = null;
    }

    public function testRegister()
    {
        $layoutRegister = new \Dxw\Iguana\Theme\LayoutRegister($this->getHelpers());

        $this->assertInstanceOf(\Dxw\Iguana\Registerable::class, $layoutRegister);

        \WP_Mock::expectFilterAdded('template_include', [\Dxw\Iguana\Theme\Layout::class, 'apply'], 99);

        $layoutRegister->register();
    }

    public function testConstruct()
    {
        $helpers = $this->getHelpers(\Dxw\Iguana\Theme\LayoutRegister::class, [
            'w_requested_template' => 'wRequestedTemplate',
        ]);

        $layoutRegister = new \Dxw\Iguana\Theme\LayoutRegister($helpers);

        $this->assertFunctionsRegistered();
    }

    public function testWRequestedTemplate()
    {
        $layoutRegister = new \Dxw\Iguana\Theme\LayoutRegister($this->getHelpers());

        $file = \org\bovigo\vfs\vfsStream::setup()->url().'/file.php';
        file_put_contents($file, '<?php global $called; $called++;');
        \Dxw\Iguana\Theme\Layout::$wordpress_template = $file;

        global $called;
        $called = 0;

        $layoutRegister->wRequestedTemplate();

        $this->assertEquals(1, $called);
    }
}
