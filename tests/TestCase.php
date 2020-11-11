<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Tests;

use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Nthmedia\Stockbase\Facades\Stockbase;
use Nthmedia\Stockbase\FakeStockbaseClient;
use Nthmedia\Stockbase\StockbaseServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected FakerGenerator $faker;
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

    /**
     * Set Faker default locale
     */
    protected function setUpFaker(): void
    {
        $this->faker = FakerFactory::create('nl_NL');
    }

    protected function setUpFakeStockbaseClient(): void
    {
        app()->bind('stockbase', function () {
            return resolve(FakeStockbaseClient::class);
        });
    }
}
