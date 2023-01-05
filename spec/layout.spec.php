<?php


describe('Layout', function () {
    beforeEach(function () {
        \WP_Mock::setUp();
    });

    afterEach(function () {
        \WP_Mock::tearDown();

        \Dxw\Iguana\Theme\Layout::$wordpress_template = null;
        \Dxw\Iguana\Theme\Layout::$base = null;
    });

    describe('->apply()', function () {
        it('applies layout correctly', function () {
            expect(\Dxw\Iguana\Theme\Layout::apply('x/y/z.php'))->toBeAnInstanceOf(\Dxw\Iguana\Theme\Layout::class);
            expect('x/y/z.php')->toEqual(
                \dxw\iguana\theme\layout::$wordpress_template
            );
            expect('z')->toEqual(
                \dxw\iguana\theme\layout::$base
            );
        });
    });

    describe('->toString()', function () {
        it('returns the expected template name', function () {
            $layout = new \Dxw\Iguana\Theme\Layout();
            $layout->slug = 'slug';

            \WP_Mock::onFilter('roots_wrap_slug')
            ->with(['layouts/main.php'])
            ->reply(['layouts/my-layout.php']);

            \WP_Mock::wpFunction('locate_template', [
            'args' => [['layouts/my-layout.php']],
            'return' => 'correct output',
            ]);

            expect(
                $layout->__toString()
            )->toEqual('correct output');
        });
    });
});
