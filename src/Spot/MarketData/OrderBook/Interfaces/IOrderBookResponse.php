<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Interfaces;

use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;

interface IOrderBookResponse
{
    public function getTime(): \DateTime;
    public function getAsks(): EntityCollection;
    public function getBids(): EntityCollection;
}