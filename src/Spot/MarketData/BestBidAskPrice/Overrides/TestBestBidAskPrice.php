<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\BestBidAskPrice;

final class TestBestBidAskPrice extends BestBidAskPrice
{
    use OverrideExecuteTrait;
}