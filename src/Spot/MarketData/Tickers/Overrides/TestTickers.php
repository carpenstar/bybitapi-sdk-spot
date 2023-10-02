<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Tickers;

final class TestTickers extends Tickers
{
    use OverrideExecuteTrait;
}