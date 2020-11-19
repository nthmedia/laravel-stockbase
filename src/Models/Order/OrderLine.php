<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Models\Order;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class OrderLine extends FlexibleDataTransferObject
{
    public int $Number;
    public string $EAN;
    public int $Amount;
    public float $Price;
}
