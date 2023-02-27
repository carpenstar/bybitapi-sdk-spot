<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Interfaces;

interface ILastTradedPriceResponse
{
    public function getSymbol(): string;
    public function getPrice(): float;
}