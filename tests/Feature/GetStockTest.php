<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Tests\Feature;

use Carbon\Carbon;
use Nthmedia\Stockbase\Facades\Stockbase;
use Nthmedia\Stockbase\Models\Stock\StockCollection;
use Nthmedia\Stockbase\Tests\TestCase;

class GetStockTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        parent::setUpFakeStockbaseClient();
    }

    public function test_valid_request(): void
    {
        $stock = Stockbase::getStock();
        $stockCollection = StockCollection::createFromStockResponse($stock);

        $this->assertEquals([
            [
                'brand' => 'Test brand 1',
                'code' => '58432',
                'supplier_code' => '_TEST_SUPPLIER',
                'supplier_gln' => '',
                'items' => [
                    [
                        'ean' => '1000000000001',
                        'quantity' => 1,
                        'never_out_of_stock' => false,
                        'updated_at' => Carbon::now()->subDay()->format('Y-m-d H:i:s'),
                    ],
                    [
                        'ean' => '1000000000002',
                        'quantity' => 1,
                        'never_out_of_stock' => false,
                        'updated_at' => Carbon::now()->subDays(2)->format('Y-m-d H:i:s'),
                    ],
                    [
                        'ean' => '1000000000003',
                        'quantity' => 0,
                        'never_out_of_stock' => false,
                        'updated_at' => Carbon::now()->subDays(3)->format('Y-m-d H:i:s'),
                    ],
                ],
            ],
            [
                'brand' => 'Test brand 2',
                'code' => '58343',
                'supplier_code' => '_TEST_SUPPLIER',
                'supplier_gln' => '',
                'items' => [
                    [
                        'ean' => '2000000000001',
                        'quantity' => 1,
                        'never_out_of_stock' => true,
                        'updated_at' => Carbon::now()->subDay()->format('Y-m-d H:i:s'),
                    ],
                    [
                        'ean' => '2000000000002',
                        'quantity' => 0,
                        'never_out_of_stock' => false,
                        'updated_at' => Carbon::now()->subDays(2)->format('Y-m-d H:i:s'),
                    ],
                    [
                        'ean' => '2000000000003',
                        'quantity' => 0,
                        'never_out_of_stock' => false,
                        'updated_at' => Carbon::now()->subDays(3)->format('Y-m-d H:i:s'),
                    ],
                ],
            ],
        ], $stockCollection->toArray());
    }
}
