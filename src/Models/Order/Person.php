<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Models\Order;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class Person extends FlexibleDataTransferObject
{
    public string $Initials;
    public string $FirstName;
    public string $SurnamePrefix;
    public string $Surname;
    public string $Company;
    public ?string $EmailAddress;
    public ?string $Telephone;
}
