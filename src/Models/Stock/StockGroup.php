<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Models\Stock;

use Spatie\DataTransferObject\DataTransferObject;

class StockGroup extends DataTransferObject
{
    public string $brand;
    public string $code;
    public string $supplier_code;
    public string $supplier_gln;

    /**
     * @var \Nthmedia\Stockbase\Models\Stock\Stock[]
     */
    public array $items;

    public function __construct(array $parameters = [])
    {
        parent::__construct([
            'brand' => $parameters['Brand'],
            'code' => $parameters['Code'],
            'supplier_code' => $parameters['SupplierCode'],
            'supplier_gln' => $parameters['SupplierGLN'],
            'items' => $parameters['Items'],
        ]);
    }
}
