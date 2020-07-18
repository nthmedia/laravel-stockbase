<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Models\Stock;

use Illuminate\Support\Collection;
use Spatie\DataTransferObject\DataTransferObjectCollection;

final class StockCollection extends DataTransferObjectCollection
{
    public static function createFromStockResponse(array $data): self
    {
        return new static(StockGroup::arrayOf($data['Groups']));
    }

    public function toCombinedGroupAndStockCollection(): Collection
    {
        return collect($this->collection)
            ->map(function ($groupItem) {
                return collect($groupItem->items)

                    // Merge the group attributes into each stock item
                    ->map(function ($stockItem) use ($groupItem) {
                        return array_merge([
                            'brand' => $groupItem->brand,
                            'code' => $groupItem->code,
                            'supplier_code' => $groupItem->supplier_code,
                            'supplier_gln' => $groupItem->supplier_gln,
                        ], $stockItem->toArray());
                    });
            });
    }

    public function toFlattenedCombinedGroupAndStockCollection(): Collection
    {
        return $this->toCombinedGroupAndStockCollection()->flatten(1);
    }
}
