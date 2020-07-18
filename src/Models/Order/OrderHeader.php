<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Models\Order;

use Spatie\DataTransferObject\DataTransferObject;

class OrderHeader extends DataTransferObject
{
    public string $OrderNumber;
    public string $TimeStamp;
    public string $Attention;
}
