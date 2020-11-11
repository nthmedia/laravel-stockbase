<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Models\Stock;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class Stock extends FlexibleDataTransferObject
{
    public string $ean;
    public int $quantity;
    public bool $never_out_of_stock;
    public string $updated_at;

    public function __construct(array $parameters = [])
    {
        parent::__construct([
            'ean' => $parameters['EAN'],
            'quantity' => $parameters['Amount'],
            'never_out_of_stock' => $parameters['NOOS'],
            'updated_at' => \DateTime::createFromFormat('U', (string) $parameters['Timestamp'])->format('Y-m-d H:i:s'),
        ]);
    }
}
