<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Interfaces;

interface IMergedOrderBookPriceResponse
{
    public function getPrice(): float;
    public function getQuantity(): float;
}