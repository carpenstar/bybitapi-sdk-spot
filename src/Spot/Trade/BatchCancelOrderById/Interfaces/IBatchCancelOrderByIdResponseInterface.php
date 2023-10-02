<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Interfaces;

interface IBatchCancelOrderByIdResponseInterface
{
    public function getOrderId(): int;
    public function getCode(): string;
}