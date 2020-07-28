<?php


namespace Nthmedia\Stockbase;


use Carbon\Carbon;
use Nthmedia\Stockbase\Models\Stock\Stock;
use Nthmedia\Stockbase\Models\Stock\StockCollection;
use Nthmedia\Stockbase\Models\Stock\StockGroup;

class FakeStockbaseClient
{
    public function getStock(): array
    {
        return [
            'Groups' => [
                [
                    'Brand' => 'Test brand 1',
                    'Code' => '58432',
                    'SupplierCode' => '_TEST_SUPPLIER',
                    'SupplierGLN' => '',
                    'Items' => [
                        [
                            'EAN' => '1000000000001',
                            'Amount' => 1,
                            'NOOS' => false,
                            'Timestamp' => Carbon::now()->subDays(1)->format('u'),
                        ],
                        [
                            'EAN' => '1000000000002',
                            'Amount' => 1,
                            'NOOS' => false,
                            'Timestamp' => Carbon::now()->subDays(2)->format('u'),
                        ],
                        [
                            'EAN' => '1000000000003',
                            'Amount' => 0,
                            'NOOS' => false,
                            'Timestamp' => Carbon::now()->subDays(3)->format('u'),
                        ],
                    ],
                ],
                [
                    'Brand' => 'Test brand 2',
                    'Code' => '58343',
                    'SupplierCode' => '_TEST_SUPPLIER',
                    'SupplierGLN' => '',
                    'Items' => [
                        [
                            'EAN' => '2000000000001',
                            'Amount' => 1,
                            'NOOS' => true,
                            'Timestamp' => Carbon::now()->subDays(1)->format('u'),
                        ],
                        [
                            'EAN' => '2000000000002',
                            'Amount' => 0,
                            'NOOS' => false,
                            'Timestamp' => Carbon::now()->subDays(2)->format('u'),
                        ],
                        [
                            'EAN' => '2000000000003',
                            'Amount' => 0,
                            'NOOS' => false,
                            'Timestamp' => Carbon::now()->subDays(3)->format('u'),
                        ],
                    ],
                ],
            ]
        ];
    }
}
