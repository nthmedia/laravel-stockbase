<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Models\Order;

use Spatie\DataTransferObject\DataTransferObject;

class Order extends DataTransferObject
{
    public OrderHeader $OrderHeader;

    /**
     * @var \Nthmedia\Stockbase\Models\Order\OrderLine[]
     */
    public $OrderLines;

    public OrderDelivery $OrderDelivery;
}
