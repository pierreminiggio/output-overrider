<?php

namespace PierreMiniggio\OutputOverriderTest;

use PHPUnit\Framework\TestCase;
use PierreMiniggio\OutputOverrider\OutputOverrider;

class OutputOverriderTest extends TestCase
{

    public function testABunchOfStuff()
    {
        $tests = [
            [
                'before' => function () {
                    echo 'test';
                },
                'after' => 'test'
            ],
            [
                'before' => function () {
                    echo 'test';
                    echo ' ';
                    echo 'test2';
                },
                'after' => 'test test2'
            ],
            [
                'before' => function () {
                    for ($i = 0; $i < 10; $i++) {
                        echo $i;
                    }
                },
                'after' => '0123456789'
            ]
        ];

        $overrider = new OutputOverrider();

        foreach ($tests as $test) {
            $this->assertSame($test['after'], $overrider->getStdOutContent($test['before']));
        }
    }
}
