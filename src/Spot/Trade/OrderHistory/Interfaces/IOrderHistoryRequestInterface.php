<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Interfaces;

interface IOrderHistoryRequestInterface
{
    public function getSymbol(): string;
    public function getOrderId(): int;
    public function getLimit(): int;
    public function getStartTime(): int;
    public function getEndTime(): int;
    public function getOrderCategory(): int;
}