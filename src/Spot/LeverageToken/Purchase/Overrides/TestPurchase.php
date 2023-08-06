<?php
namespace Carpenstar\ByBitAPI\Spot\LeverageToken\Purchase\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\LeverageToken\Purchase\Purchase;

final class TestPurchase extends Purchase
{
    use OverrideExecuteTrait;
}