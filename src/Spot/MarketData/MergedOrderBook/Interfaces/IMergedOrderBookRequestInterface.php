<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Interfaces;

interface IMergedOrderBookRequestInterface
{
    public function getSymbol(): string;
    public function setSymbol(string $symbol): self;
    public function getScale(): int;
    public function setScale(int $scale): self;
    public function getLimit(): int;
    public function setLimit(int $limit): self;
}