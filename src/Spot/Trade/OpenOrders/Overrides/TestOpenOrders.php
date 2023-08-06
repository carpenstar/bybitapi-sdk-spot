<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\OpenOrders\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\Trade\OpenOrders\OpenOrders;

final class TestOpenOrders extends OpenOrders
{
    use OverrideExecuteTrait;
}