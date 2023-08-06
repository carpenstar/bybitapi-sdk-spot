<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\Interfaces;

interface ITradeHistoryRequestInterface
{
    public function getSymbol(): string;
    public function getOrderId(): int;
    public function getEndTime(): int;
    public function getStartTime(): int;
    public function getLimit(): int;
    public function getToTradeId(): int;
    public function getFromTradeId(): int;
}