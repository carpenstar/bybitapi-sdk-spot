<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\OpenOrders\Interfaces;

interface IOpenOrdersRequestInterface
{
    public function getSymbol(): string;
    public function getOrderId(): int;
    public function getLimit(): int;
    public function getOrderCategory(): int;
}