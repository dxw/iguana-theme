<?php

describe(\Dxw\Iguana\Theme\Layout::class, function () {
	beforeEach(function () {
		$this->layout = new \Dxw\Iguana\Theme\Layout();
	});

	afterEach(function () {
		\Dxw\Iguana\Theme\Layout::$wordpress_template = null;
		\Dxw\Iguana\Theme\Layout::$base = null;
	});

	it("test apply", function () {
		$test = $this->layout::apply('x/y/z.php');
		expect($test)->toBeAnInstanceOf(\Dxw\Iguana\Theme\Layout::class);
		expect(\Dxw\Iguana\Theme\Layout::$wordpress_template)->toBe('x/y/z.php');
		expect(\Dxw\Iguana\Theme\Layout::$base)->toBe('z');

		$testIndex = $this->layout::apply('x/y/index.php');
		expect(\Dxw\Iguana\Theme\Layout::$wordpress_template)->toBe('x/y/index.php');
		expect(\Dxw\Iguana\Theme\Layout::$base)->toBe(false);

	});

	it("test _toString", function () {
		$this->layout->slug = 'slug';
		$this->layout->templates = ['layouts/main.php'];

		allow('apply_filters')->toBeCalled()
		->with('roots_wrap_'.$this->layout->slug, $this->layout->templates)
		->andReturn(['layouts/my-layout.php']);

		allow('locate_template')
		->toBeCalled()
		->with(['layouts/my-layout.php'])
		->andReturn('correct output');

		expect($this->layout->__toString())->toBe('correct output');
	});

	it("test constructor", function () {
		expect($this->layout->slug)->toBe('main');
		expect($this->layout->templates)->toBe(['layouts/main.php']);

		\Dxw\Iguana\Theme\Layout::$base = 'page';
		$test = new \Dxw\Iguana\Theme\Layout();
		expect($test->templates)->toBe(['layouts/main-page.php','layouts/main.php']);
	});
});
