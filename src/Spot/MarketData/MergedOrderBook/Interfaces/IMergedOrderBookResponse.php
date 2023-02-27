<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Interfaces;

use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;

interface IMergedOrderBookResponse
{
    public function getTime(): \DateTime;
    public function getAsks(): EntityCollection;
    public function getBids(): EntityCollection;
}