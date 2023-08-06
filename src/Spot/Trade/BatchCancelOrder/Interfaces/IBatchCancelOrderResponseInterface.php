<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder;

interface IBatchCancelOrderResponseInterface
{
    public function getSuccess(): bool;
}