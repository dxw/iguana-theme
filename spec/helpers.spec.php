<?php

describe('->registerFunction()', function () {
    it('registers a function', function () {
        $helpers = new \Dxw\Iguana\Theme\Helpers();

        $helpers->registerFunction('myFunc', function () {
            return 42;
        });

        expect($helpers->myFunc())->toEqual(42);
    });
    it('registers a function with arguments', function () {
        $helpers = new \Dxw\Iguana\Theme\Helpers();

        $helpers->registerFunction('anotherFunc', function ($a, $b) {
            return 42 + $a + $b;
        });

        expect($helpers->anotherFunc(1, 5))->toEqual(48);
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
