<?php

describe(\Dxw\Iguana\Theme\Helpers::class, function () {
	beforeEach(function () {
		$this->helpers = new \Dxw\Iguana\Theme\Helpers();
	});

	it("test registerFunction", function () {
		$this->helpers->registerFunction('myFunc', function () {
			return 42;
		});
		expect($this->helpers->__call('myFunc', []))->toBe(42);
	});

	it("test registerFunction arguements", function () {
		$this->helpers->registerFunction('anotherFunc', function ($a, $b) {
			return 42 + $a + $b;
		});
		expect($this->helpers->__call('anotherFunc', [1,5]))->toBe(48);
	});

	it("test register", function () {
		expect($this->helpers)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);

		expect(function_exists('h'))->toBe(false);
		$this->helpers->register();
		expect(function_exists('h'))->toBe(true);
	});
});
