<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\MergedOrderBook;

final class TestMergedOrderBook extends MergedOrderBook
{
    use OverrideExecuteTrait;
}