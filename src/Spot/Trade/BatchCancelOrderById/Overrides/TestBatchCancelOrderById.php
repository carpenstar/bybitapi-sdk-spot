<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\BatchCancelOrderById;

final class TestBatchCancelOrderById extends BatchCancelOrderById
{
    use OverrideExecuteTrait;
}