<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Tests;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Nthmedia\Stockbase\Facades\Stockbase;
use Nthmedia\Stockbase\Models\Order\Address;
use Nthmedia\Stockbase\Models\Order\Order;
use Nthmedia\Stockbase\Models\Order\OrderDelivery;
use Nthmedia\Stockbase\Models\Order\OrderHeader;
use Nthmedia\Stockbase\Models\Order\Person;

class CreateOrderTest extends TestCase
{
    use WithFaker;

    public function test_create_order(): void
    {
        $order = new Order([
            'OrderHeader' => new OrderHeader([
                'OrderNumber' => (string) $this->faker->numberBetween(1000000000, 9000000000),
                'TimeStamp' => Carbon::now()->format('Y-m-d H:i:s'),
                'Attention' => '',
            ]),
            'OrderLines' => [
                [
                    'Number' => 1,
                    'EAN' => '2000000000003',
                    'Amount' => 1,
                ],
                [
                    'Number' => 2,
                    'EAN' => '2000000000002',
                    'Amount' => 1,
                ],
            ],
            'OrderDelivery' => new OrderDelivery([
                'Person' => new Person([
                    'Initials' => '',
                    'FirstName' => $this->faker->firstName(),
                    'SurnamePrefix' => '',
                    'Surname' => $this->faker->lastName(),
                    'Company' => '',
                ]),
                'Address' => new Address([
                    'Street' => 'Koraalrood',
                    'StreetNumber' => '33',
                    'ZipCode' => '2718 SB',
                    'City' => 'Zoetermeer',
                    'CountryCode' => 'NLD',
                ]),
            ]),
        ]);

        $response = Stockbase::createOrder($order->toArray());
        $this->assertEquals(1, $response['StatusCode']);
    }
}
