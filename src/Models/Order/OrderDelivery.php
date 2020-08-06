<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Models\Order;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class OrderDelivery extends FlexibleDataTransferObject
{
    public Person $Person;
    public Address $Address;
}
