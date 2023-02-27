<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\Interfaces;

interface BestBidAskPrice
{
    public function getSymbol(): string;
    public function getAskPrice(): float;
    public function getAskQty(): float;
    public function getBidPrice(): float;
    public function getBidQty(): float;
    public function getTime(): \DateTime;
}