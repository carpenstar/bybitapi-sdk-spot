<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo\InstrumentInfo;

final class TestInstrumentInfo extends InstrumentInfo
{
    use OverrideExecuteTrait;
}