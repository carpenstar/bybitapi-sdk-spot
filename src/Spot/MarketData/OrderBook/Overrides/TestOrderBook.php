<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\OrderBook;

final class TestOrderBook extends OrderBook
{
    use OverrideExecuteTrait;
}