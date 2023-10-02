<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\Kline\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\MarketData\Kline\Kline;

final class TestKline extends Kline
{
    use OverrideExecuteTrait;
}