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
use Nthmedia\Stockbase\Models\Order\OrderResponse;
use Nthmedia\Stockbase\Models\Order\Person;

class CreateOrderTest extends TestCase
{
    use WithFaker;

    public function test_create_order(): void
    {
        $orderNumber = (string) $this->faker->numberBetween(1000000000, 9000000000);
        $timestamp = Carbon::now()->toDateTimeLocalString();
        $customer = [
            'firstName' => $this->faker->firstName(),
            'lastName' => $this->faker->lastName(),
            'street' => $this->faker->streetName(),
            'houseNumber' => $this->faker->buildingNumber(),
            'zipCode' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'country' => 'NLD',
        ];

        $order = $this->createOrder($orderNumber, $timestamp, $customer);

        $response = Stockbase::createOrder($order->toArray());

        tap($response['Items'][0]['OrderRequest']['OrderHeader'], function ($orderHeader) use ($orderNumber) {
            $this->assertEquals($orderNumber, $orderHeader['OrderNumber']);
        });

        tap($response['Items'][0]['OrderRequest']['OrderLines'][0], function ($orderLine1) {
            $this->assertEquals(2000000000003, $orderLine1['EAN']);
            $this->assertEquals(1, $orderLine1['Amount']);
        });

        tap($response['Items'][0]['OrderRequest']['OrderLines'][1], function ($orderLine1) {
            $this->assertEquals(2000000000002, $orderLine1['EAN']);
            $this->assertEquals(1, $orderLine1['Amount']);
        });

        tap($response['Items'][0]['OrderRequest']['OrderDelivery'], function ($orderDelivery) use ($customer) {
            $this->assertEquals($customer['firstName'], $orderDelivery['Person']['FirstName']);
            $this->assertEquals($customer['lastName'], $orderDelivery['Person']['Surname']);

            $this->assertEquals($customer['street'], $orderDelivery['Address']['Street']);
            $this->assertEquals($customer['houseNumber'], $orderDelivery['Address']['StreetNumber']);
            $this->assertEquals($customer['zipCode'], $orderDelivery['Address']['ZipCode']);
            $this->assertEquals($customer['city'], $orderDelivery['Address']['City']);
            $this->assertEquals($customer['country'], $orderDelivery['Address']['CountryCode']);
        });
    }

    public function test_create_order_parse_with_order_response(): void
    {
        $orderNumber = (string) $this->faker->numberBetween(1000000000, 9000000000);
        $timestamp = Carbon::now()->toDateTimeLocalString();
        $customer = [
            'firstName' => $this->faker->firstName(),
            'lastName' => $this->faker->lastName(),
            'street' => $this->faker->streetName(),
            'houseNumber' => $this->faker->buildingNumber(),
            'zipCode' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'country' => 'NLD',
        ];

        $order = $this->createOrder($orderNumber, $timestamp, $customer);

        $response = Stockbase::createOrder($order->toArray());
        $response = OrderResponse::createFromRequest($response);

        $this->assertEquals(1, $response->StatusCode);
        $this->assertEquals($order->OrderHeader, $response->OrderResponse->OrderHeader);
        $this->assertEquals($order->OrderLines, $response->OrderResponse->OrderLines);
        $this->assertEquals($order->OrderDelivery, $response->OrderResponse->OrderDelivery);
    }


    protected function createOrder(string $orderNumber, string $timestamp, array $customer): Order {
        return $order = new Order([
            'OrderHeader' => new OrderHeader([
                'OrderNumber' => $orderNumber,
                'TimeStamp' => $timestamp,
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
                    'FirstName' => $customer['firstName'],
                    'SurnamePrefix' => '',
                    'Surname' => $customer['lastName'],
                    'Company' => '',
                ]),
                'Address' => new Address([
                    'Street' => $customer['street'],
                    'StreetNumber' => $customer['houseNumber'],
                    'ZipCode' => $customer['zipCode'],
                    'City' => $customer['city'],
                    'CountryCode' => $customer['country'],
                ]),
            ]),
        ]);
    }
}
