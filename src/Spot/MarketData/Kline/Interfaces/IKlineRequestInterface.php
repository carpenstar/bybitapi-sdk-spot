<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\Kline\Interfaces;

interface IKlineRequestInterface
{
    public function setSymbol(string $symbol): self;
    public function getSymbol(): string;
    public function setLimit(int $limit): self;
    public function getLimit(): int;
    public function setInterval(string $interval): self;
    public function getInterval(): string;
    public function setStartTime(int $startTime): self;
    public function getStartTime(): int;
    public function setEndTime(int $endTime): self;
    public function getEndTime(): int;
}