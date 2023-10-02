<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Interfaces;

interface IBatchCancelOrderByIdRequestInterface
{
    public function getOrderIds(): string;
    public function getOrderCategory(): int;
}