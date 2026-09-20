<?php

use Kahlan\Matcher\ToBe;

describe(\Dxw\Iguana\Theme\LayoutRegister::class, function () {
	beforeEach(function () {
		$this->helpers = new \Dxw\Iguana\Theme\Helpers();
		$this->layoutRegister = new \Dxw\Iguana\Theme\LayoutRegister($this->helpers);
	});

	it("test register", function () {
		expect($this->layoutRegister)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);

		allow('add_filter')
		->toBeCalled()
		->with('template_include', [\Dxw\Iguana\Theme\Layout::class, 'apply'], 99)
		->andReturn(true);

		expect('add_filter')->toBeCalled()->once();
		$this->layoutRegister->register();
	});

	it("test constructor", function () {
		file_put_contents('mock_template.php', '<?php global $value; $value = 1;');
		\Dxw\Iguana\Theme\Layout::$wordpress_template = 'mock_template.php';
		$this->helpers->__call('w_requested_template', []);
		global $value;
		expect($value)->toBe(1);
		unlink('mock_template.php');
	});

	it("test wRequestedTemplate", function () {

		$file = \org\bovigo\vfs\vfsStream::setup()->url().'/file.php';
		file_put_contents($file, '<?php global $called; $called++;');
		\Dxw\Iguana\Theme\Layout::$wordpress_template = $file;

		global $called;
		$this->layoutRegister->wRequestedTemplate();
		expect($called)->toBe(1);
	});
});
