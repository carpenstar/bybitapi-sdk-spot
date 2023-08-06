<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\PublicTradingRecords;

final class TestPublicTradingRecords extends PublicTradingRecords
{
    use OverrideExecuteTrait;
}