<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Models\Order;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class OrderHeader extends FlexibleDataTransferObject
{
    public string $OrderNumber;
    public string $TimeStamp;
    public string $Attention;
}
