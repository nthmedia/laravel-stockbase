<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase;

use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Nthmedia\Stockbase\Contracts\StockbaseClientContract;

class FakeStockbaseClient implements StockbaseClientContract
{
    private FakerGenerator $faker;

    public function __construct()
    {
        $this->faker = FakerFactory::create();
    }

    public function getStock(?\DateTime $since = null, ?\DateTime $until = null): array
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
                            'Timestamp' => Carbon::now()->subDays(1)->format('U'),
                        ],
                        [
                            'EAN' => '1000000000002',
                            'Amount' => 1,
                            'NOOS' => false,
                            'Timestamp' => Carbon::now()->subDays(2)->format('U'),
                        ],
                        [
                            'EAN' => '1000000000003',
                            'Amount' => 0,
                            'NOOS' => false,
                            'Timestamp' => Carbon::now()->subDays(3)->format('U'),
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
                            'Timestamp' => Carbon::now()->subDays(1)->format('U'),
                        ],
                        [
                            'EAN' => '2000000000002',
                            'Amount' => 0,
                            'NOOS' => false,
                            'Timestamp' => Carbon::now()->subDays(2)->format('U'),
                        ],
                        [
                            'EAN' => '2000000000003',
                            'Amount' => 0,
                            'NOOS' => false,
                            'Timestamp' => Carbon::now()->subDays(3)->format('U'),
                        ],
                    ],
                ],
            ],
        ];
    }

    public function createOrder(array $order): array
    {
        return [
            'StatusCode' => 1,
            'Items' => [
                [
                    'StatusCode' => 1,
                    'OrderRequest' => [
                        'ClientGUID' => $this->faker->uuid(),
                        'OrderSystem' => 0,
                        'OrderSystemSettings' => [],
                        'IsValid' => true,
                        'ValidationResults' => [],
                        'ErrorMessage' => '',
                        'GUID' => $this->faker->uuid(),
                        'Statuses' => [
                            [
                                'Code' => 3,
                                'Date' => '2020-10-07T18:17:11.473',
                                'Message' => 'Success from GenericOrderSystem.',
                            ],
                        ],
                        'OrderHeader' => [
                            'GUID' => $this->faker->uuid(),
                            'OrderNumber' => $order['OrderHeader']['OrderNumber'],
                            'Part' => '1',
                            'TimeStamp' => Carbon::now()->format('Y-m-d\TH:i:s'),
                            'Attention' => '',
                            'SellingPointGLN' => '',
                            'IsValid' => true,
                            'ValidationResults' => [],
                        ],
                        'OrderLines' => [
                            [
                                'OrderRequestGUID' => '00000000-0000-0000-0000-000000000000',
                                'GUID' => $this->faker->uuid(),
                                'Number' => 1,
                                'EAN' => '2000000000003',
                                'Amount' => 1,
                                'BrandID' => 1122,
                                'Metadata' => [],
                                'BrandCode' => '',
                                'IsValid' => true,
                                'ValidationResults' => [],
                            ],
                            [
                                'OrderRequestGUID' => '00000000-0000-0000-0000-000000000000',
                                'GUID' => $this->faker->uuid(),
                                'Number' => 2,
                                'EAN' => '2000000000002',
                                'Amount' => 1,
                                'BrandID' => 1122,
                                'Metadata' => [],
                                'BrandCode' => '',
                                'IsValid' => true,
                                'ValidationResults' => [],
                            ],
                        ],
                        'OrderDelivery' => [
                            'GUID' => $this->faker->uuid(),
                            'Person' => [
                                'Gender' => 0,
                                'Initials' => $order['OrderDelivery']['Person']['Initials'],
                                'FirstName' => $order['OrderDelivery']['Person']['FirstName'],
                                'SurnamePrefix' => $order['OrderDelivery']['Person']['SurnamePrefix'],
                                'Surname' => $order['OrderDelivery']['Person']['Surname'],
                                'Company' => $order['OrderDelivery']['Person']['Company'],
                                'EmailAddress' => $order['OrderDelivery']['Person']['EmailAddress'],
                                'Telephone' => $order['OrderDelivery']['Person']['Telephone'],
                                'IsValid' => true,
                                'ValidationResults' => [],
                            ],
                            'Address' => [
                                'Street' => $order['OrderDelivery']['Address']['Street'],
                                'StreetNumber' => $order['OrderDelivery']['Address']['StreetNumber'],
                                'StreetNumberAddition' => $order['OrderDelivery']['Address']['StreetNumberAddition'],
                                'ZipCode' => $order['OrderDelivery']['Address']['ZipCode'],
                                'City' => $order['OrderDelivery']['Address']['City'],
                                'CountryCode' => $order['OrderDelivery']['Address']['CountryCode'],
                                'IsValid' => true,
                                'ValidationResults' => [],
                            ],
                            'IsValid' => true,
                            'ValidationResults' => [],
                        ],
                    ],
                    'ExceptionMessage' => '',
                ],
            ],
        ];
    }
}
