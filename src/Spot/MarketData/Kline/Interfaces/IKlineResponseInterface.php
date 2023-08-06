<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\Kline\Interfaces;

interface IKlineResponseInterface
{
    public function getTime(): \DateTime;
    public function getSymbol(): string;
    public function getAlias(): string;
    public function getClosePrice(): float;
    public function getHighPrice(): float;
    public function getLowPrice(): float;
    public function getOpenPrice(): float;
    public function getTradingVolume(): float;
}