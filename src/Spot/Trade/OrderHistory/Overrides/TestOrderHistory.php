<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\OrderHistory;

final class TestOrderHistory extends OrderHistory
{
    use OverrideExecuteTrait;
}