<?php


namespace Nthmedia\Stockbase\Models\Order;


class OrderResponse extends \Spatie\DataTransferObject\FlexibleDataTransferObject
{
    public int $StatusCode;
    public Order $OrderResponse;

    public static function createFromRequest(array $parameters = []): self
    {
        return new static([
            'StatusCode' => $parameters['StatusCode'],
            'OrderResponse' => $parameters['Items'][0]['OrderRequest']
        ]);
    }
}