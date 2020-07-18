<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Models\Order;

use Spatie\DataTransferObject\DataTransferObject;

class OrderDelivery extends DataTransferObject
{
    public Person $Person;
    public Address $Address;
}
