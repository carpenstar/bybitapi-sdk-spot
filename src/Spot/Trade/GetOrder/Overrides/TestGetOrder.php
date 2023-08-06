<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\GetOrder\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\Trade\GetOrder\GetOrder;

final class TestGetOrder extends GetOrder
{
    use OverrideExecuteTrait;
}