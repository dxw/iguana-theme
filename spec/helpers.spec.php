<?php

describe('->registerFunction()', function () {
    it('registers and calls the myFunc function', function () {
        $helpers = new \Dxw\Iguana\Theme\Helpers();
        $helpers->registerFunction('myFunc', function () {
            return 42;
        });
        expect(42)->toEqual($helpers->myFunc());
    });
    it('handles arguments in the anotherFunc function', function () {
        $helpers = new \Dxw\Iguana\Theme\Helpers();
        $helpers->registerFunction('anotherFunc', function ($a, $b) {
            return 42 + $a + $b;
        });
        expect(48)->toEqual($helpers->anotherFunc(1, 5));
    });
});
describe('->register()', function () {
    it('registers the "h" function', function () {
        $helpers = new \Dxw\Iguana\Theme\Helpers();
        expect($helpers)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
        expect(function_exists('h'))->toBeFalsy();
        $helpers->register();
        expect(function_exists('h'))->toBeTruthy();
    });
});
