<?php

namespace Dxw\Iguana\Theme;

trait Testing
{
    public function initHelpers(/* string */ $cls = '', array $expectedFunctions = [])
    {
        $this->expectedFunctions = $expectedFunctions;

        $helpers = $this->getMockBuilder(\Dxw\Iguana\Theme\Helpers::class)
        ->disableOriginalConstructor()
        ->getMock();

        $this->called = [];

        if (($cls === '' && $expectedFunctions !== []) || $cls !== '' && $expectedFunctions === []) {
            throw new \Exception('set both arguments or leave both blank');
        }

        if ($cls !== '') {
            $helpers->method('registerFunction')
            ->will($this->returnCallback(function ($a, $b) use ($cls) {
                $this->assertInternalType('array', $b);
                $this->assertInstanceOf($cls, $b[0]);
                $this->called[$a] = $b[1];
            }));
        }

        \WP_Mock::wpFunction('h', [
            'args' => [],
            'return' => $helpers,
        ]);
    }

    public function assertFunctionsRegistered()
    {
        $this->assertEquals($this->expectedFunctions, $this->called);
    }
}
