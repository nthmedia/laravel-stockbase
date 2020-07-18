<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Tests;

use Nthmedia\Stockbase\Facades\Stockbase;
use Nthmedia\Stockbase\StockbaseServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     */
    protected function getPackageProviders($app)
    {
        return [StockbaseServiceProvider::class];
    }

    /**
     * Load package alias
     */
    protected function getPackageAliases($app)
    {
        return [
            'Stockbase' => Stockbase::class,
        ];
    }
}
