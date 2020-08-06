<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Models\Order;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class Address extends FlexibleDataTransferObject
{
    public string $Street;
    public string $StreetNumber;
    public string $ZipCode;
    public string $City;
    public string $CountryCode;
}
