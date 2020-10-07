<?php


namespace Nthmedia\Stockbase\Contracts;


interface StockbaseClientContract
{
    public function getStock(?\DateTime $since = null, ?\DateTime $until = null): array;
    public function createOrder(array $order): array;
}