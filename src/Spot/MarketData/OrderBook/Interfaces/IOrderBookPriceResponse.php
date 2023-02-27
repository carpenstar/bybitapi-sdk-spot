<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Interfaces;

interface IOrderBookPriceResponse
{
    public function getPrice(): float;
    public function getQuantity(): float;
}