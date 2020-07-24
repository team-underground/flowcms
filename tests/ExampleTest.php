<?php

namespace Flowcms\Flowcms\Tests;

use Orchestra\Testbench\TestCase;
use Flowcms\Flowcms\FlowcmsServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [FlowcmsServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
