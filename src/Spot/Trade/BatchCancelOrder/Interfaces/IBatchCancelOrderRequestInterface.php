<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder;

interface IBatchCancelOrderRequestInterface
{
    public function getSymbol(): string;
    public function getSide(): string;
    public function getOrderTypes(): string;
    public function getOrderCategory(): int;
}