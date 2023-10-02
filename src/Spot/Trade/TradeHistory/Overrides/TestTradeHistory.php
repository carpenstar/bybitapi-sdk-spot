<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\TradeHistory;

final class TestTradeHistory extends TradeHistory
{
    use OverrideExecuteTrait;
}