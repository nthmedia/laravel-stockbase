<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Models\Order;

use Spatie\DataTransferObject\DataTransferObject;

class OrderLine extends DataTransferObject
{
    public int $Number;
    public string $EAN;
    public int $Amount;
}
