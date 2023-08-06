<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder\BatchCancelOrder;

final class TestBatchCancelOrder extends BatchCancelOrder
{
    use OverrideExecuteTrait;
}