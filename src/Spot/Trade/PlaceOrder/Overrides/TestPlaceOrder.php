<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\PlaceOrder;

final class TestPlaceOrder extends PlaceOrder
{
    use OverrideExecuteTrait;
}