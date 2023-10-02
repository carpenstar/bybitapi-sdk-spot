<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\LastTradedPrice;

final class TestLastTradedPrice extends LastTradedPrice
{
    use OverrideExecuteTrait;
}