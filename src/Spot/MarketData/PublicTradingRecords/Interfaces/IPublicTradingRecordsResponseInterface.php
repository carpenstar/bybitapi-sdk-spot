<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Interfaces;

interface IPublicTradingRecordsResponseInterface
{
    public function getPrice(): float;
    public function getQuantity(): float;
    public function getTime(): \DateTime;
    public function getIsBuyerMaker(): bool;
    public function getType(): int;
}