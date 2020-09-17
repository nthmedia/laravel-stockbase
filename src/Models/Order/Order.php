<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Models\Order;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class Order extends FlexibleDataTransferObject
{
    public OrderHeader $OrderHeader;

    /**
     * @var \Nthmedia\Stockbase\Models\Order\OrderLine[]
     */
    public $OrderLines;

    public ?OrderDelivery $OrderDelivery;
}
