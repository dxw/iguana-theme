<?php

use Kahlan\Plugin\Double;

describe('LayoutRegister', function () {
    beforeEach(function () {
        \WP_Mock::setUp();
        $this->helpers = Double::instance(['extends' => '\Dxw\Iguana\Theme\Helpers']);
    });

    afterEach(function () {
        \WP_Mock::tearDown();

        \Dxw\Iguana\Theme\Layout::$wordpress_template = null;
    });

    describe('->register', function () {
        it('passes if successfully registers Layout->apply() as callback function to filter hook', function () {
            $layoutRegister = new \Dxw\Iguana\Theme\LayoutRegister($this->helpers);

            expect($layoutRegister)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);

            \WP_Mock::expectFilterAdded('template_include', [\Dxw\Iguana\Theme\Layout::class, 'apply'], 99);

            $layoutRegister->register();
        });
    });

    describe('->construct', function () {
        it('registers `wRequestedTemplate`', function () {
            $layoutRegister = new \Dxw\Iguana\Theme\LayoutRegister($this->helpers);
            
            expect(get_class_methods($layoutRegister))->toContain('wRequestedTemplate');
        });
    });

    describe('->wRequestedTemplate', function () {
        it('', function () {
            $layoutRegister = new \Dxw\Iguana\Theme\LayoutRegister($this->helpers);

            $file = \org\bovigo\vfs\vfsStream::setup()->url().'/file.php';
            file_put_contents($file, '<?php global $called; $called++;');
            \Dxw\Iguana\Theme\Layout::$wordpress_template = $file;

            global $called;
            $called = 0;
    
            $layoutRegister->wRequestedTemplate();
    
            expect($called)->toEqual(1);
        });
    });
});
