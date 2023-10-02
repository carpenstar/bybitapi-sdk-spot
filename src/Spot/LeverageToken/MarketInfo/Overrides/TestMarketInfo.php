<?php
namespace Carpenstar\ByBitAPI\Spot\LeverageToken\MarketInfo\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\LeverageToken\MarketInfo\MarketInfo;

final class TestMarketInfo extends MarketInfo
{
    use OverrideExecuteTrait;
}